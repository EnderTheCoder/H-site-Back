<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json; charset=utf-8');
require "./core/mysqlCore.php";
require "./core/customFunctions.php";
$conn = mysqliConnect();
if(!$conn){
    die("mysql error!");
}
if(!emptyCheck($_POST['username']) ||
    !emptyCheck($_POST['password']) ||
    !emptyCheck($_POST['email'])) {
    stdJqReturn($conn, FALSE);
}
$username = addslashes(sprintf("%s",$_POST['username']));
$password = addslashes(sprintf("%s",$_POST['password']));
$email = addslashes(sprintf("%s",$_POST['email']));
$username = substr($username,0,15);
$password = substr($password,0,40);
$email = substr($email,0,30);
$regDate = date("Y/m/d");
$res = registCheck($conn, $username, $password, $regDate, $email);
stdJqReturn($conn, $res);