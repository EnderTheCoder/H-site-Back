<?php
//返回true或false代表是否登录
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json; charset=utf-8');
session_start();
include "./core/customFunctions.php";
stdJqReturn(emptyCheck($_SESSION['username']));