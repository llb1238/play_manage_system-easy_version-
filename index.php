<?php

include("php/common.php");

$Err="";
$password = $user = "";
$sccessful = "";
$flag = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user = $_POST['username'];
    $password = $_POST['password'];  
    
    $sql = "select * from user_pass where username = (?) and password = (?)";
    $mysql_stmt = $conn->prepare($sql);
    
    $mysql_stmt->bind_param('ss',$user,$password);
    
    $result = $mysql_stmt->exectu();
    if($result -> num_rows >0){
        header("Location: choice.php");
    }
    else{
        $Err="<br>username or password is not correct";
    }

    
  
  
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body><form action="" class="login" method="post">
    <p>Login</p>
    <input type="text" placeholder="用户名" name="username">
    <input type="password" placeholder="密码" name="password">
    <input type="submit" class="btn" value="登  录">
    <span class="error"> <?php echo $Err;?></span>
</form>
    
</body>
</html>