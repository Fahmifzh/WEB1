<?php
include '../config.php';
include 'auth_check.php';


$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM kategori WHERE id='$id'");

header("Location: kategori.php");
