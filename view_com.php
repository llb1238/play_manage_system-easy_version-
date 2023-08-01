<?php

include("php/common.php");


// 定义变量并默认设为空值

$sql = "select * from production_company";

$result = $conn->query($sql);

?>



<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/view_com.css">
</head>
<body>
    <form action="" class="login" >
        <p>view companies</p>
        <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Telephone</th>
            </tr>

            <?php
            // check if the query returns any result
            if ($result->num_rows > 0) {
                // fetch data for each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['c_id'] . "</td>";
                    echo "<td>" . $row['c_name'] . "</td>";
                    echo "<td>" . $row['c_telephone'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "No results found";
            }
            ?>
        </table>
        </div>
        <input type="button" class="btn btn-space" value="back" onclick="location.href='choice.php';">
    </form>
</body>
</html>