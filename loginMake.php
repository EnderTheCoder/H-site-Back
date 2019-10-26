<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json; charset=utf-8');
require "./core/mysqlCore.php";
require "./core/customFunctions.php";
$conn = mysqliConnect();
if (!$conn) {
    die("mysql error!");
}
if(!emptyCheck($_POST['username']) ||
    !emptyCheck($_POST['password']) ||
    !emptyCheck($_POST['captcha']) ||
    $_SESSION['captcha'] != $_POST['captcha'])
    stdJqReturn($conn, FALSE);
$username = addslashes(sprintf("%s",$_POST['username']));
$password = addslashes(sprintf("%s",$_POST['password']));
$username = substr($username,0,15);
$password = substr($password,0,40);
$lastLoginDate = date("Y/m/d");
$lastLoginIP = $_SERVER['REMOTE_ADDR'];
$passwordGet = getPasswordByUsername($conn, $username);
if(!$passwordGet || $passwordGet != $password)
    stdJqReturn($conn, FALSE);
else {
    if(updateLoginInf($conn, $username, $lastLoginIP, $lastLoginDate)) {
        $_SESSION['username'] = $username;
        stdJqReturn($conn, TRUE);
    }
}