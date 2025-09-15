<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    if (isset($_COOKIE['status']) && (string)$_COOKIE['status'] === '1') {
        $_SESSION['status'] = true;
        if (!isset($_SESSION['userid']) && isset($_COOKIE['remember_user'])) {
            $_SESSION['userid'] = $_COOKIE['remember_user'];
        }
        if (!isset($_SESSION['role']) && isset($_COOKIE['remember_role'])) {
            $c = strtolower(trim((string)$_COOKIE['remember_role']));
            $_SESSION['role'] = ($c === 'admin') ? 'Admin' : 'User';
        }
    } else {
        header('location: ../view/login.php?error=badrequest');
        exit;
    }
}

$id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;
if ($id === 0 && isset($_SESSION['userid'])) {
    $tmp = getUserByUserId($_SESSION['userid']); // ✅ use userid lookup
    $id = isset($tmp['id']) ? (int)$tmp['id'] : 0;
}

$user = [];
if ($id > 0) {
    $user = getUserById($id);
}

function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

$name   = $user['username'] ?? ($_SESSION['username'] ?? 'User');
$userid = $user['userid'] ?? ($_SESSION['userid'] ?? '—');  // ✅ show userid
$type   = $_SESSION['role'] ?? 'User';

$dashboardPage = (strtolower($type) === 'admin') ? 'admin_dashboard.php' : 'user_dashboard.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>My Profile</title>
    <link rel="stylesheet" type="text/css" href="../asset/auth.css">
    <style>
        .profile-card { max-width:400px; margin:40px auto; padding:20px; border:1px solid #ddd; border-radius:8px; background:#fafafa; font-family:Arial,sans-serif; }
        .meta { margin:12px 0; font-size:16px; color:#333; }
        .profile-actions { margin-top:20px; }
        .profile-actions input { padding:8px 14px; border:1px solid #555; border-radius:6px; cursor:pointer; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">My Profile</h1>
    <form class="profile-card">
        <div class="meta"><strong>Name:</strong> <?= h($name) ?></div>
        <div class="meta"><strong>User ID:</strong> <?= h($userid) ?></div> <!-- ✅ changed -->
        <div class="meta"><strong>User Type:</strong> <?= h($type) ?></div>

        <div class="profile-actions">
            <input type="button" value="Back to Dashboard" onclick="window.location.href='<?= h($dashboardPage) ?>'">
        </div>
    </form>
</body>
</html>
