<?php
require "./config/mysqlConfig.php";
function mysqliConnect() {
    $conn = new mysqli(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    if (!$conn) {
        return false;
    }
    mysqli_query($conn, "set names utf8");
    mysqli_select_db($conn, MYSQL_DB_NAME);
    return $conn;
}

function registCheck($conn, $username, $password, $regDate, $email) {
    $stmt = $conn->prepare("INSERT INTO userInf (username, password, regDate, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $username, $password, $regDate, $email);
    return $stmt->execute();
}

function getPasswordByUsername($conn, $username) {
    $stmt = $conn->prepare("SELECT password FROM userInf where username = ?");
    $stmt->bind_param('s', $username);
    $result = $stmt->execute();
    if(!$result) return FALSE;
    $row = $result->fetch_assoc();
    return $row['password'];
}

function updateLoginInf($conn, $username, $lastLoginIP, $lastLoginDate) {
    $stmt = $conn->prepare("UPDATE userInf SET lastLoginIP = '?', lastLoginDate = '?' WHERE username = '?'");
    $stmt->bind_param('sss', $lastLoginIP, $lastLoginDate, $username);
    return $stmt->execute();
}