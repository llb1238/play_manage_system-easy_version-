<?php
$servername = "localhost";
$username = "root";
$password = "";
$mydb = "mydb";
 
// 创建连接
$conn = new mysqli($servername, $username, $password,$mydb);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";

$conn ->close();
?>
