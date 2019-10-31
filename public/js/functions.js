function openPlayerLobby(ID) {
	window.location.href = ('/~levko/players/lobby.php?id='+ID);
}
function openMatchLobby(ID) {
    window.location.href = ('/~levko/tournaments/matchLobby.php?id=' + ID);
}
function openTournamentLobby(ID) {
	window.location.href = ('/~levko/tournaments/lobby.php?id=' + ID);
}
function openRating(ID) {
	window.location.href = ('/~levko/rankings/ranking.php?id=' + ID);
}
function openYoutube(event, youtube) {
    event.stopPropagation();

    window.location.href=(youtube);
}

