<?php 
require '../../config.php';
session_start();

if(isset($_GET['ORDER'])){
    $_SESSION['GenerateOrderID'] = $_GET['ORDER'];
    $_SESSION['Total'] = $_GET['amount'];
    echo "<script>window.location.href= ' ../PayPal/charge.php';</script>";
}