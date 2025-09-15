<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    header('location: ../view/login.php?error=badrequest');
    exit;
}
if (strtolower($_SESSION['role']) !== 'admin') {
    header('location: ../view/login.php?error=badrequest');
    exit;
}

$allUsers = getAlluser();
$filteredUsers = [];
foreach ($allUsers as $u) {
    if (isset($u['role']) && strtolower($u['role']) === 'user') {
        $filteredUsers[] = $u;
    }
}

function h($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Management</title>
    <link rel="stylesheet" type="text/css" href="../asset/ad.css">
    <style>
        .admin-card{max-width:900px;margin:18px auto;padding:18px;background:#fff;border-radius:8px;box-shadow:0 0 8px #ddd}
        table.users{width:100%;border-collapse:collapse;margin-top:12px}
        table.users th, table.users td{border:1px solid #e1e1e1;padding:8px;text-align:left}
        table.users th{background:#f7f7f7}
        table.users tr:nth-child(even){background:#fafafa}
    </style>
</head>
<body>
    <div class="admin-card">
        <h1>Registered Users</h1>
        <table class="users" aria-describedby="users-list">
            <caption id="users-list">All registered users</caption>
            <thead>
                <tr>
                    <th style="width:10%">ID</th>
                    <th style="width:30%">Username</th>
                    <th style="width:40%">User ID</th>
                    <th style="width:20%">Role</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($filteredUsers)): ?>
                    <?php foreach ($filteredUsers as $user): ?>
                        <tr>
                            <td><?= h($user['id']) ?></td>
                            <td><?= h($user['username']) ?></td>
                            <td><?= h($user['userid']) ?></td>
                            <td><?= h($user['role']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <br>
        <input type="button" value="Back to Dashboard" onclick="window.location.href='admin_dashboard.php'">
    </div>
</body>
</html>
