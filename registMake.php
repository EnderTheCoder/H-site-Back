<?php
/*接口使用指南
 * 返回-1代表输入存在空
 * 返回-2代表验证码错误
 * 返回-3代表未知数据库错误
 * 返回1代表登陆成功
 * */
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json; charset=utf-8');
require "./core/mysqlCore.php";
require "./core/customFunctions.php";
session_start();
$captcha = $_SESSION['captcha'];
$_SESSION['captcha'] = rand();
$conn = mysqliConnect();
if(!$conn){
    die("mysql error!");
}
if(!emptyCheck($_POST['username']) ||
    !emptyCheck($_POST['password']) ||
    !emptyCheck($_POST['email']) ||
    !emptyCheck($_POST['captcha'])
    ) stdJqSqlReturn($conn, -1);
if($_SESSION['captcha'] != $captcha) stdJqSqlReturn($conn, -2);
$username = addslashes(sprintf("%s",$_POST['username']));
$password = addslashes(sprintf("%s",$_POST['password']));
$email = addslashes(sprintf("%s",$_POST['email']));
$username = substr($username,0,15);
$password = substr($password,0,40);
$email = substr($email,0,30);
$regDate = date("Y/m/d");
$res = registCheck($conn, $username, $password, $regDate, $email);
if($res) stdJqSqlReturn($conn, 1);
else stdJqSqlReturn($conn, -3);