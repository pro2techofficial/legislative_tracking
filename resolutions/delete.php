<?php
include "../config.php"; require_login();
$id=(int)($_GET['id'] ?? 0);
mysqli_query($conn,"DELETE FROM resolutions WHERE id=$id");
mysqli_query($conn,"DELETE FROM tracking_history WHERE legislation_type='Resolution' AND legislation_id=$id");
log_action($conn,"Deleted resolution ID $id","Resolution");
header("Location: index.php"); exit();
?>
