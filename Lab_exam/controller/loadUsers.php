<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$roleFilter = $_POST['roleFilter'] ?? 'All';
$allUsers = getAlluser();
$filteredUsers = [];

if ($roleFilter === 'All') {
    $filteredUsers = $allUsers;
} else {
    foreach ($allUsers as $user) {
        if (isset($user['role']) && $user['role'] === $roleFilter) {
            $filteredUsers[] = $user;
        }
    }
}

if (count($filteredUsers) > 0) {
    $cleanedUsers = [];
    foreach ($filteredUsers as $u) {
        $cleanedUsers[] = [
            'id'       => $u['id'] ?? '',
            'username' => $u['username'] ?? '',
            'userid'   => $u['userid'] ?? '',
            'role'     => $u['role'] ?? ''
        ];
    }

    echo json_encode([
        'status' => 'success',
        'users'  => $cleanedUsers
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No users found.'
    ]);
}
?>
