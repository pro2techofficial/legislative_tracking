<?php require_once __DIR__ . '/../config.php'; require_login();
$currentPath = $_SERVER['REQUEST_URI'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Municipal Legislative Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/mlts/assets/css/style.css">
</head>
<body>
<div class="app">
<?php include __DIR__ . "/sidebar.php"; ?>
<main class="content">
<header class="top">
    <div>
        <h4>Municipal Legislative Tracking System</h4>
        <p><?= e($_SESSION['fullname'] ?? 'User') ?> | <?= e($_SESSION['role'] ?? 'Staff') ?></p>
    </div>
    <div class="top-date"><i class="bi bi-calendar3"></i> <?= date('F d, Y') ?></div>
</header>
