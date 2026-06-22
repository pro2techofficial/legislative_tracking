<?php
require_once "../config.php";
log_action($conn, "Logged out", "Authentication");
session_destroy();
header("Location: login.php");
exit();
?>
