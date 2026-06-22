<?php
date_default_timezone_set('Asia/Manila');
$conn = mysqli_connect("localhost", "root", "", "mlts_db");
if (!$conn) { die("Database connection failed: " . mysqli_connect_error()); }
if (session_status() === PHP_SESSION_NONE) { session_start(); }

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /mlts/auth/login.php");
        exit();
    }
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';
}

function log_action($conn, $action, $module) {
    $uid = $_SESSION['user_id'] ?? 0;
    $action = mysqli_real_escape_string($conn, $action);
    $module = mysqli_real_escape_string($conn, $module);
    mysqli_query($conn, "INSERT INTO audit_logs(user_id, action, module) VALUES('$uid','$action','$module')");
}

function upload_document($fieldName) {
    if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowed = ['pdf','doc','docx','jpg','jpeg','png'];
    $ext = strtolower(pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
        return null;
    }

    $dir = __DIR__ . "/assets/uploads/";
    if (!is_dir($dir)) { mkdir($dir, 0777, true); }

    $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", basename($_FILES[$fieldName]['name']));
    $target = $dir . $filename;

    if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target)) {
        return "assets/uploads/" . $filename;
    }

    return null;
}
?>
