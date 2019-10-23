function openPlayerLobby(ID) {
	window.location.href = ('/~levko/admin/players/lobby.php?id='+ID);
}
function openMatchLobby(ID) {
    window.location.href = ('/~levko/admin/tournaments/matchLobby.php?id=' + ID);
}
function openTournamentLobby(ID) {
	window.location.href = ('/~levko/admin/tournaments/lobby.php?id=' + ID);
}
function openYoutube(event, youtube) {
    event.stopPropagation();

    window.location.href=(youtube);
}

