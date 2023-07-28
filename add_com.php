<?php

include("php/common.php");


// 定义变量并默认设为空值
$nameErr = $telErr= "";
$name = $tel = "";
$sccessful = "";
$flag = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["c_name"])) {
    $nameErr = "* company name is necessary.<br>";
    $flag = 0;
  } else {
    $name = $_POST["c_name"];
    $nameErr = "";
  }

  
  if (empty($_POST["c_tel"])) {
    $telErr = "* company telephone is necessary.<br>";
    $flag = 0;
  } else {
    if (!preg_match("/^[0-9]*$/",$_POST["c_tel"]))
    {
        $telErr = "* number only<br>"; 
        $flag = 0;
    }
    elseif(strlen($_POST["c_tel"])>11){
        $telErr = "* too long<br>"; 
        $flag = 0;
    }
    else{
        $tel = $_POST["c_tel"];
        $telErr = "";
    }
    
  }

  if($flag){
    $sql = "insert into production_company (c_name,c_telephone) values (?,?)";
    $mysql_stmt = $conn->prepare($sql);
    
    
    $mysql_stmt->bind_param('si',$name,$tel);
    
    if($mysql_stmt->execute()){
        $sccessful = "sccessful";
    }
    else {
        echo $mysql_stmt->error;
    }
  }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/add_com.css">
</head>
<body>
    <form action="" class="login" method="post">
        <p>add company</p>
        <input type="text" name="c_name" placeholder="company name">
        <input type="tel" name="c_tel" placeholder="commpany tel">
        <input type="submit" class="btn" value="submit">
        <br>
        <span class="error"> <?php echo $sccessful;?></span>
        <span class="error"> <?php echo $nameErr;?></span>
        <span class="error"> <?php echo $telErr;?></span>
    </form>
</body>
</html>