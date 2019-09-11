<?php

require("../../../includes/adminConfig.php");

$title = "Admin Panel - Tournaments";

adminRender("tournaments/index.php", ["title"=>$title]);

?>
