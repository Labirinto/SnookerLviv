-- SAME ORDER

DROP PROCEDURE IF EXISTS tournamentPointsGenerate;
DROP PROCEDURE IF EXISTS seedPlayer;

DROP PROCEDURE IF EXISTS tournamentStatusUpdate;
DROP TRIGGER IF EXISTS tournamentInsertionDate;
DROP PROCEDURE IF EXISTS checkTournamentStatus;

DROP TRIGGER IF EXISTS finishTournament;

DROP EVENT IF EXISTS tournamentEvent;
DROP PROCEDURE IF EXISTS getFirstGreaterPowerOf2;


delimiter $$

CREATE PROCEDURE seedPlayer(IN tournament INT, IN counter INT, IN rType VARCHAR(20), IN seed INT)
BEGIN
	DECLARE matchID, playerID INT DEFAULT -1;
	
	SELECT M.id INTO matchID
	FROM _match M WHERE M.tournamentID = tournament AND M.roundType = rType AND M.counter = counter;
	
	SELECT PT.playerID INTO playerID 
	FROM playerTournament PT
	WHERE PT.tournamentID = tournament AND PT.seed = seed;

	IF matchID != -1 THEN
		CALL putPlayerIntoMatch(matchID, playerID, 0);
	END IF;
END;



-- generates points
-- TODO proper points, now POW(2, roundNo);
CREATE PROCEDURE tournamentPointsGenerate(IN tournamentID INT, IN group_R INT, IN LOW_R INT, IN KO_R INT)
BEGIN
	DECLARE i INT DEFAULT 1;
-- add points for group
	
	SET i = 1;
	WHILE i <= group_R DO
		INSERT INTO tournamentPoints(tournamentID, lostInRoundNo, lostInRoundType, points)
		VALUES(tournamentID, group_R-i+1, "Group", POW(2, i));
		SET i = i+1;
	END WHILE;

-- insert points for LOW rounds
	SET i = 1;
	WHILE i <= LOW_R DO
		INSERT INTO tournamentPoints(tournamentID, lostInRoundNo, lostInRoundType, points)
		VALUES(tournamentID, i, "LOW", POW(2, i+group_R));
		SET i = i+1;
	END WHILE;
	
-- insert points for K/O rounds
	SET i = 1;
	WHILE i <= KO_R+1 DO
		INSERT INTO tournamentPoints(tournamentID, lostInRoundNo, lostInRoundType, points)
		VALUES(tournamentID, i, "K/O", POW(2, i+LOW_R+group_R));
		SET i = i+1;
	END WHILE;
END;



-- STATUS UPDATE  depending on dates and current time --------------
CREATE PROCEDURE tournamentStatusUpdate( INOUT status VARCHAR(20), IN regBeginDate DATETIME, IN regEndDate DATETIME )
BEGIN
    SET @curr = CURRENT_TIMESTAMP;

	IF status = "Announced"
	THEN
		IF(@curr >= regBeginDate AND @curr < regEndDate)
		THEN
			SET status = "Registration";

		ELSEIF(@curr >= regEndDate)
		THEN
			SET status = "Standby";
		END IF;

	ELSEIF status = "Registration"
	THEN
		IF(@curr >= regEndDate)
		THEN
			SET status = "Standby";
		END IF;
	END IF;
END;



-- DATES BEFORE INSERT check and fill if empty -----------------------
CREATE TRIGGER tournamentInsertionDate BEFORE INSERT ON tournament
FOR EACH ROW
BEGIN
-- if regEnd was not set then set it a day later after regBegin
    IF( isnull(NEW.regEndDate) ) THEN
        SET NEW.regEndDate = ADDDATE(NEW.regBeginDate, 1);
    END IF; 

   	CALL tournamentStatusUpdate(NEW.status, NEW.regBeginDate, NEW.regEndDate);
END;



-- update ratings for finished tournament based on points in TournamentPoints
-- all points are provided b this time (after each match)
CREATE TRIGGER finishTournament AFTER UPDATE ON tournament
FOR EACH ROW 
BEGIN
    IF OLD.status != "Finished" AND NEW.status = "Finished" THEN
    -- update rating for each player
        UPDATE rating R INNER JOIN tournamentStandings TS ON R.playerID=TS.playerID
        SET R.points = R.points+TS.points WHERE R.leagueID=NEW.leagueID AND TS.tournamentID=NEW.id;
    END IF;
END;



-- STATUS UPDATE for Announced and Registration-- ------------------
CREATE PROCEDURE checkTournamentStatus ()
BEGIN
    DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE id INT;
    DECLARE status VARCHAR(20);
    DECLARE regBeginDate,regEndDate DATETIME;

	DECLARE cur CURSOR FOR
	SELECT T.id, T.status, T.regBeginDate, T.regEndDate
    FROM tournament T WHERE T.status IN ("Announced", "Registration");

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;
    read_loop: LOOP
        SET done = FALSE;
        FETCH cur INTO id, status, regBeginDate, regEndDate;
        
		IF done THEN
            LEAVE read_loop;
        END IF;
        CALL tournamentStatusUpdate(status, regBeginDate, regEndDate);
        UPDATE tournament T SET T.status = status WHERE T.id = id;
    END LOOP;
    CLOSE cur;
END;
$$
delimiter ;



-- EVERY 30 MINUTES UPDATE STATUSES ----------------------------------
CREATE EVENT tournamentEvent
    ON SCHEDULE EVERY 30 MINUTE
DO
    CALL checkTournamentStatus();



-- HELPER for Players Counting
delimiter $$
CREATE PROCEDURE getFirstGreaterPowerOf2 (INOUT X INT)
BEGIN
    DECLARE N INT DEFAULT 2;
    WHILE N < X DO
        SET N = N * 2;
    END WHILE;
    SET X = N;
END;
$$
delimiter ;



