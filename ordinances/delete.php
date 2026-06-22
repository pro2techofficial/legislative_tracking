<?php
include "../config.php"; require_login();
$id=(int)($_GET['id'] ?? 0);
mysqli_query($conn,"DELETE FROM ordinances WHERE id=$id");
mysqli_query($conn,"DELETE FROM tracking_history WHERE legislation_type='Ordinance' AND legislation_id=$id");
log_action($conn,"Deleted ordinance ID $id","Ordinance");
header("Location: index.php"); exit();
?>
