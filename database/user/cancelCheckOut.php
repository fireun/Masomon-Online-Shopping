<?php

include("../../config.php");
session_start();

if($_SESSION['Page_link_Id']){
    $cartId = $_SESSION['Page_link_Id'];
    $deleteCartId = "update cartintegration set cartId = '' where cartId = '$cartId' AND status = ''";
    $deleteCartIdResult=$conn->query($deleteCartId);
    
    if($deleteCartIdResult == true){
        $removeCart = "delete from cart where cartId = '$cartId'";
        $removeCartResult=$conn->query($removeCart);

        if($removeCartResult == true){
            unset($_SESSION['m']);
            unset($_SESSION['newShipId']);
            echo "<script>window.location.assign('../../user/cart.php');</script>";
        }else{
            echo "<script>window.location.assign('../../user/cart.php');</script>";
        }
    }
}