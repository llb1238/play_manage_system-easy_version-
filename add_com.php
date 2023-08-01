<?php

include("php/common.php");


// 定义变量并默认设为空值
$nameErr = $telErr= "";
$name = $tel = "";
$sccessful = "";
$flag = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $action = $_POST['action'];
  if($action === "add"){
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
  elseif($action === "delete"){
    $delete_com = $_POST['delete_com'];
    $sql = "delete from production_company where c_id = ? ";
    $mysql_stmt = $conn->prepare($sql);

    $mysql_stmt->bind_param('i',$delete_com);
    if($mysql_stmt->execute()){
      $sccessful = "sccessful";
    }
    else{
      echo $mysql_stmt->error;
    }
  }
  elseif($action === "change"){
    $id = $_POST['change_com'];

    if (empty($_POST["change_name"])) {
      $flag = 0;
    } else {
      $name = $_POST["change_name"];
    }
  
    
    if (empty($_POST["change_tel"])) {
      $flag = 0;
    } else {
      if (!preg_match("/^[0-9]*$/",$_POST["change_tel"]))
      {
          $flag = 0;
      }
      elseif(strlen($_POST["change_tel"])>11){
          $flag = 0;
      }
      else{
          $tel = $_POST["change_tel"];
      }
      
    }
  
    if($flag){
      $sql = "update production_company set c_name = ?,c_telephone = ? where c_id = ?";
      $mysql_stmt = $conn->prepare($sql);
      
      
      $mysql_stmt->bind_param('sii',$name,$tel,$id);
      
      if($mysql_stmt->execute()){
          $sccessful = "sccessful";
      }
      else {
          echo $mysql_stmt->error;
      }
    }
  }
  
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add_com</title>
    <link rel="stylesheet" href="./css/add_com.css">
    <script src="./js/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <form action="" class="login" method="post" id="myform">
        <p>update company</p>
        <span class="sp">update way:</span> 
        <select name="action" id="action">
            <option value="add">add</option>
            <option value="change">change</option>
            <option value="delete">delete</option>
        </select>

        <div id="addInputs">
          <input type="text" name="c_name" placeholder="company name">
          <input type="tel" name="c_tel" placeholder="commpany tel">

          <input type="button" class="btn btn-space" value="back" onclick="location.href='choice.php';">
          <input type="submit" class="btn btn-space" value="submit">
          <br>
          
          <span class="error"> <?php echo $nameErr;?></span>
          <span class="error"> <?php echo $telErr;?></span>
        </div>

        <div id="deleteInputs">
          <span>delete company name:</span>
          <select name="delete_com" id="delete_com">
            <?php
              $sql = "select * from production_company";
              $result =  $conn -> query($sql);
              while($row = $result->fetch_assoc()){
                echo "<option value=\"{$row['c_id']}\">{$row['c_name']}</option>";
              }
            ?>
          </select>
          <br>
          <input type="button" class="btn btn-space" value="back" onclick="location.href='choice.php';">
          <input type="submit" class="btn btn-space" value="delete">
          <br>
        </div>

        <div id="changeInputs">
          <span class="sp">change com_name:</span>
          <select name="change_com" id="change_com">
            <?php
              $sql = "select * from production_company";
              $result =  $conn -> query($sql);
              while($row = $result->fetch_assoc()){
                echo "<option value=\"{$row['c_id']}\">{$row['c_name']}</option>";
              }
            ?>
          </select>
          <input type="text" name="change_name" placeholder="company name">
          <input type="tel" name="change_tel" placeholder="commpany tel">
          
          <input type="button" class="btn btn-space" value="back" onclick="location.href='choice.php';">
          <input type="submit" class="btn btn-space" value="change">
          <br>
        </div>

        <br>
        <span class="error"> <?php echo $sccessful;?></span>


    </form>
    
    <script>
        $(document).ready(function() {
            $('#action').change(function() {
                if ($(this).val() === 'add') {
                    $('#addInputs').show();
                    $('#changeInputs').hide();
                    $('#deleteInputs').hide();
                } else if ($(this).val() === 'change') {
                    $('#addInputs').hide();
                    $('#changeInputs').show();
                    $('#deleteInputs').hide();
                } else if ($(this).val() === 'delete') {
                    $('#addInputs').hide();
                    $('#changeInputs').hide();
                    $('#deleteInputs').show();
                }
            });

            $("#change_com").change(function(){
              var cid = $(this).val();
              $.ajax({
                url: './php/get_company.php',
                type: 'post',
                data: {c_id: cid},
                dataType: 'json',
                success:function(response){
                  var len = response.length;
                  if(len > 0){
                    var cname = response[0].c_name;
                    var ctel = response[0].c_telephone;
                    
                    $("input[name='change_name']").val(cname);
                    $("input[name='change_tel']").val(ctel);
                  }
                  
                },
                error: function(jqXHR, textStatus, errorThrown){
                  console.log("Error: ", textStatus, errorThrown);
                }
              });
              
            });
        });
    </script>
</body>
</html>