<?php
session_start();
require_once('../model/userModel.php');

$data = file_get_contents("php://input");
$user = json_decode($data);

if (!$user) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data received.']);
    exit;
}

$username = trim($user->username ?? '');
$password = trim($user->password ?? '');
$userid   = trim($user->userid ?? '');
$role     = trim($user->role ?? 'User');

if ($username === "" || $password === "" || $userid === "" || $role === "") {
    echo json_encode(['status' => 'error', 'message' => 'Please fill the form correctly.']);
    exit;
}

$users = getAlluser();
foreach ($users as $u) {
    if (isset($u['userid']) && $u['userid'] === $userid) {
        echo json_encode(['status' => 'error', 'message' => 'This User ID is already registered.']);
        exit;
    }
}

$newUser = [
    'username' => $username,
    'password' => $password,
    'userid'   => $userid,
    'role'     => $role
];

$status = addUser($newUser);

if ($status) {
    echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Registration failed. Try again.']);
}
?>
