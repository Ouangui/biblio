<?php

require_once '../../conn.php';

$CodeL = $_GET['CodeL'];
$sql = 'DELETE FROM livre WHERE CodeL=:CodeL';
$query = $conn->prepare($sql);


if ($query->execute([':CodeL' => $CodeL])) {
    header("location: livre.php");
  }

?>