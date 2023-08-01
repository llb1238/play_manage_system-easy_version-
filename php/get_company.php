<?php
include("./common.php");


if(isset($_POST['c_id']) && $_POST['c_id'] != ""){
  $cid = $_POST['c_id'];
  $sql = "SELECT c_name, c_telephone FROM production_company WHERE c_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $cid);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = array();
  while($row = $result->fetch_assoc()){
    $data[] = $row;
  }
  echo json_encode($data);
}
?>
