<?php

require_once '../conn.php';

$CodeCl = $_GET['CodeCl'];
$sql = 'DELETE FROM classe WHERE CodeCl=:CodeCl';
$query = $conn->prepare($sql);


if ($query->execute([':CodeCl' => $CodeCl])) {
    header("location: classe.php");
  }







?>