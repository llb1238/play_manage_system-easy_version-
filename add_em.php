<?php

include("php/common.php");


// 定义变量并默认设为空值
$nameErr = $telErr= $addressErr = $jobErr = "";
$name = $tel = $address = $job = "";
$sccessful = "";
$flag = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["e_name"])) {
    $nameErr = "* employee name is necessary.<br>";
    $flag = 0;
  } else {
    $name = $_POST["e_name"];
    $nameErr = "";
  }

  
  if (empty($_POST["e_tel"])) {
    $telErr = "* employee telephone is necessary.<br>";
    $flag = 0;
  } else {
    if (!preg_match("/^[0-9]*$/",$_POST["e_tel"]))
    {
        $telErr = "* number only<br>"; 
        $flag = 0;
    }
    elseif(strlen($_POST["e_tel"])>11){
        $telErr = "* too long<br>"; 
        $flag = 0;
    }
    else{
        $tel = $_POST["e_tel"];
        $telErr = "";
    }
    
  }

  if (empty($_POST["e_addr"])) {
    $addressErr = "* employee address is necessary.<br>";
    $flag = 0;
  } else {
    $address = $_POST["e_addr"];
    $addressErr = "";
  }

  if (empty($_POST["e_job"])) {
    $jobErr = "* employee job is necessary.<br>";
    $flag = 0;
  } else {
    $job = $_POST["e_job"];
    $jobErr = "";
  }

  if($flag){
    $sql = "insert into employee (name,address,job_type,telephone) values (?,?,?,?)";
    $mysql_stmt = $conn->prepare($sql);
    
    
    $mysql_stmt->bind_param('sssi',$name,$address,$job,$tel);
    
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
    <link rel="stylesheet" href="css/add_em.css">
</head>
<body>
    <form action="" class="login" method="post">
        <p>add employee</p>
        <input type="text" name="e_name" placeholder="employee name">
        <input type="text" name="e_addr" placeholder="employee address">
        <input type="tel" name="e_tel" placeholder="employee tel">
        <label style="font-size: 25px;">job:</label>
        <input type="radio" name="e_job" value="dancer" style="width: 20px; height: 20px;"><label style="font-size: 20px;">dancer</label>
        <input type="radio" name="e_job" value="actor" style="width: 20px; height: 20px;"><label style="font-size: 20px;">actor</label>
        <br>
        <input type="button" class="btn btn-space" value="back" onclick="location.href='choice.php';">
        <input type="submit" class="btn btn-space" value="submit">
        <br>
        <span class="error"> <?php echo $sccessful;?></span>
        <span class="error"> <?php echo $nameErr;?></span>
        <span class="error"> <?php echo $addressErr;?></span>
        <span class="error"> <?php echo $telErr;?></span>       
        <span class="error"> <?php echo $jobErr;?></span>
    </form>
</body>
</html>