<?php
include '../config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM resep WHERE id='$id'");
header("Location: resep.php");
?>
