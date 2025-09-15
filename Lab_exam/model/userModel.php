<?php
require_once('db.php');

function login($user){
    $con = getConnection();
    $userid   = mysqli_real_escape_string($con, $user['userid']);
    $password = mysqli_real_escape_string($con, $user['password']);

    $sql = "SELECT * FROM users WHERE userid='{$userid}' AND password='{$password}'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        return true;
    }
    return false;
}

function addUser($user){
    $con = getConnection();
    $role = isset($user['role']) ? $user['role'] : 'User';
    $username = mysqli_real_escape_string($con, $user['username']);
    $password = mysqli_real_escape_string($con, $user['password']);
    $userid   = mysqli_real_escape_string($con, $user['userid']);
    $roleEsc  = mysqli_real_escape_string($con, $role);

    $sql = "INSERT INTO users (username, password, userid, role) 
            VALUES ('{$username}', '{$password}', '{$userid}', '{$roleEsc}')";
    return mysqli_query($con, $sql);
}

function getAlluser(){
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);
    $users = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    return $users;
}

function getUserById($id){
    $con = getConnection();
    $id = (int)$id;
    $sql = "SELECT * FROM users WHERE id={$id}";
    $result = mysqli_query($con, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return null;
}

function getUserByUserId($userid){ 
    $con = getConnection();
    $userid = mysqli_real_escape_string($con, $userid);
    $sql = "SELECT * FROM users WHERE userid='{$userid}' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return null;
}

function updateUser($user){
    $con = getConnection();
    if (empty($user['id'])) return false;

    $id = (int)$user['id'];
    $username = isset($user['username']) ? mysqli_real_escape_string($con, $user['username']) : '';
    $userid   = isset($user['userid']) ? mysqli_real_escape_string($con, $user['userid']) : '';
    $role     = isset($user['role']) ? mysqli_real_escape_string($con, $user['role']) : '';

    $sql = "UPDATE users 
            SET username='{$username}', userid='{$userid}', role='{$role}'
            WHERE id={$id}";
    return mysqli_query($con, $sql);
}

function deleteUser($id){
    $con = getConnection();
    $id = (int)$id;
    if ($id <= 0) return false;

    $sql = "DELETE FROM users WHERE id={$id}";
    return mysqli_query($con, $sql);
}

function getTotalUsers() {
    $con = getConnection();
    $sql = "SELECT COUNT(*) AS total_users FROM users";
    $result = mysqli_query($con, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return (int)$row['total_users'];
    }
    return 0;
}
?>
