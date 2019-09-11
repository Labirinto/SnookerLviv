#!/bin/sh
mysql -u marker -p123456 snookerLviv < initDatabase.sql
mysql -u marker -p123456 snookerLviv < views.sql
mysql -u marker -p123456 snookerLviv < groupMatches.sql
mysql -u marker -p123456 snookerLviv < matchProcedures.sql
mysql -u marker -p123456 snookerLviv < liveMatchProcedures.sql
mysql -u marker -p123456 snookerLviv < tournamentProcedures.sql
mysql -u marker -p123456 snookerLviv < KOprocedures.sql
mysql -u marker -p123456 snookerLviv < DEprocedures.sql
mysql -u marker -p123456 snookerLviv < GROUP-KOprocedures.sql
mysql -u marker -p123456 snookerLviv < fillDatabase.sql
