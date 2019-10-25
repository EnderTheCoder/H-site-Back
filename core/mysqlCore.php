<?php
require "./config/mysql_config.php";
function mysqliConnect() {
    $conn = new mysqli(MYSQL_HOST, MYSQL_USER_NAME, MYSQL_PASSWORD);
    if (!$conn) {
        return false;
    }
    mysqli_query($conn, "set names utf8");
    mysqli_select_db($conn, MYSQL_DB_NAME);
    return $conn;
}

function registCheck($conn, $username, $password, $regTime, $email) {
    $stmt = $conn->prepare("INSERT INTO userInf (username, password, regTime, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $username, $password, $regTime, $email);
    return $stmt->execute();
}