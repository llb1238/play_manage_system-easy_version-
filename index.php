<?php

include("php/common.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="" class="login">
        <p>Manage System</p>
        <button onclick="window.location.href='add_com.php'" type="button" class="btn">add company</button>
        <br>
        <button onclick="window.location.href='add_em.php'" type="button" class="btn">add employee</button>
    </form>
</body>
</html>