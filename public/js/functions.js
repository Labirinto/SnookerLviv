function openPlayerLobby(playerID){
	window.location.href = ('/~levko/admin/players/lobby.php?id=' + playerID);
}
function openMatchLobby(matchID) {
    window.location.href=('/~levko/admin/tournaments/matchLobby.php?id=' + matchID);
}
function openYoutube(event, youtube) {
    event.stopPropagation();

    window.location.href=(youtube);
}

