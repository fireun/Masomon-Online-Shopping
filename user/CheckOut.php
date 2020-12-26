<?php

include("../config.php");
include '../limitTimeSession.php';


if($_GET['cartId']){
    $cartId = $_GET['cartId'];
    $getProduct = "select cartintegration.*, product.*,cart.unifiedDelivery from cart left join cartintegration on cart.cartId = cartintegration.cartId LEFT JOIN product on cartintegration.productId = product.id where cartintegration.cartId = '$cartId' AND cartintegration.status = ''";
    $resultGetProduct = $conn->query($getProduct);

    if($resultGetProduct->num_rows > 0){ //over 1 database(record) so run
        $_SESSION['Page_link_Id'] = $_GET['cartId'];
    }else{
        header("Location: ../user/purchasePage.php");
        die();
    }
}else {
    // header('refresh:0;url=http://localhost/testProject/user/home.php');
    header("Location: ../user/purchasePage.php");
    die();
}

// unset($_SESSION['m']);

if(isset($_SESSION['newShipId'])){
    $ship_id = $_SESSION['newShipId'];
    $userId = $_SESSION['userId'];
    $getnewShip = "SELECT * FROM address_shipping where ship_id = '$ship_id' and user_id = '$userId'";
    $resultGetNewShip=$conn->query($getnewShip);

    if($resultGetNewShip->num_rows>0){
        while($row = $resultGetNewShip->fetch_assoc()){
            $receipt_name = $row['recipient_name'];
            $recipient_phone = $row['recipient_phone'];
            $recipient_address = $row['recipient_address'];
            $recipient_city = $row['recipient_city'];
            $recipient_state = $row['recipient_state'];
            $recipient_postalCode = $row['recipient_postalCode'];
            $recipient_country = $row['recipient_country'];

            $recipient_address = $recipient_address.",".$recipient_city.",".$recipient_state.",".$recipient_postalCode.",".$recipient_country;

        }
    }else{
        $receipt_name = " ";
        $recipient_phone = " ";
        $recipient_address = " ";
        $recipient_city = " ";
        $recipient_state = " ";
        $recipient_postalCode= " ";
        $recipient_country = " ";
        $_SESSION['newShipId'] = "noAddress";
    }
}else{
    $userId = $_SESSION['userId'];
    $getShip = "SELECT * FROM address_shipping where user_id = '$userId' and status = '0'";
    $resultGetShip=$conn->query($getShip);

    if($resultGetShip->num_rows>0){
        while($row = $resultGetShip->fetch_assoc()){
            $_SESSION['newShipId'] = $row['ship_id'];
            $receipt_name = $row['recipient_name'];
            $recipient_phone = $row['recipient_phone'];
            $recipient_address = $row['recipient_address'];
            $recipient_city = $row['recipient_city'];
            $recipient_state = $row['recipient_state'];
            $recipient_postalCode = $row['recipient_postalCode'];
            $recipient_country = $row['recipient_country'];

            $recipient_phone = "(+60".$recipient_phone.")";
            $recipient_address = $recipient_address.",".$recipient_city.",".$recipient_state.",".$recipient_postalCode.",".$recipient_country;
        }
    }else{
        $receipt_name = " ";
        $recipient_phone = " ";
        $recipient_address = " ";
        $_SESSION['newShipId'] = "noAddress";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/reset.css">
    <title>CheckOut Cart</title>
</head>
<style>
    .custome-cursor-default{
        cursor:default;
    }
    .custome-cursor-pointer {
        cursor:pointer;
    }
    .custom-input-border{
        border:0px;
    }
    .custom-input-border:focus{
        outline:0px;
    }
    .border-dotted{
        border-style: dotted;
    }
    .border-dotted-bottom{
        border: 1px dotted #dee2e6;
    }
    .modal-body1{
        display:block;
    }
    .modal-body2{
        display:none;
    }
</style>
<body style="background:#f2f2f2">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Top Nav Bar -->
            <?php require '../user/subheader.php' ?>
            <!-- End Top NavBar -->
            
            <!-- Header navbar Checkout -->
            <nav class="navbar navbar-light bg-light mt-5">
                <div class="text-sm-left custome-cursor-default" style="display:inherit">
                <svg t="1603184269921" class="icon custome-cursor-pointer gobackButton" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3167" width="32" height="32"><path d="M153.858 493.991 528.321 868.42c0 0 37.435-74.63 37.435-76.056 0-0.181-299.557-298.575-299.557-298.364 0 0.716 299.557-299.645 299.557-299.561 0 0.768-37.435-74.886-37.435-74.886L153.858 493.991zM303.898 456.568l598.849 0 0 74.875L303.898 531.443l-37.699-37.444L303.898 456.568z" p-id="3168"></path></svg>                
                 <h3 class="font-weight-Bold pl-3">
                    <!-- <svg t="1602918267517" class="icon ml-1 mr-1" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2177" width="25" height="25"><path d="M972.507599 239.169306h-262.747667L545.969179 7.132405c-6.824615-6.824615-17.061537-10.236922-23.886152-3.412308-6.824615 6.824615-10.236922 17.061537-3.412307 23.886152L665.399936 239.169306h-341.230736L474.310724 27.606249c6.824615-6.824615 3.412307-17.061537-3.412307-23.886152-6.824615-6.824615-17.061537-3.412307-23.886152 3.412308L279.809204 239.169306H17.061537c-10.236922 0-17.061537 6.824615-17.061537 17.061537s6.824615 17.061537 17.061537 17.061536h20.473844l116.01845 412.889192c10.236922 40.947688 51.18461 64.83384 102.369221 64.83384h208.15075c10.236922 0 17.061537-6.824615 17.061537-13.64923 17.061537-146.729217 139.904602-259.33536 286.633818-259.33536 30.710766 0 61.421533 6.824615 92.132299 17.061537h13.64923c3.412307-3.412307 6.824615-6.824615 6.824614-10.236922L934.972218 273.292379h37.535381c10.236922 0 17.061537-6.824615 17.061537-17.061536s-6.824615-17.061537-17.061537-17.061537zM716.584547 727.129259c0 6.824615 6.824615 17.061537 34.123074 20.473844v-44.359995c-20.473844 3.412307-34.123074 13.649229-34.123074 23.886151zM784.830694 788.550792v44.359995c20.473844-3.412307 34.123074-13.649229 34.123074-23.886151 0-3.412307-6.824615-13.649229-34.123074-20.473844z" fill="" p-id="2178"></path><path d="M767.769157 512.153895c-139.904602 0-255.923052 116.01845-255.923052 255.923053s116.01845 255.923052 255.923052 255.923052 255.923052-116.01845 255.923053-255.923052-116.01845-255.923052-255.923053-255.923053z m17.061537 358.292274v17.061536c0 10.236922-6.824615 17.061537-17.061537 17.061537s-17.061537-6.824615-17.061536-17.061537v-17.061536c-37.535381-3.412307-64.83384-27.298459-68.246148-54.596918 0-10.236922 6.824615-17.061537 13.64923-17.061537 10.236922 0 17.061537 6.824615 17.061537 13.649229 0 10.236922 13.649229 20.473844 34.123073 23.886152V785.138484c-27.298459-6.824615-68.246147-17.061537-68.246147-58.009225 0-30.710766 27.298459-54.596918 68.246147-58.009225V648.64619c0-10.236922 6.824615-17.061537 17.061537-17.061537s20.473844 6.824615 20.473844 17.061537v17.061537c37.535381 3.412307 64.83384 27.298459 68.246148 54.596917 0 10.236922-6.824615 17.061537-13.64923 17.061537-10.236922 0-17.061537-6.824615-17.061537-13.649229 0-10.236922-13.649229-20.473844-34.123073-23.886152V751.015411c27.298459 6.824615 68.246147 17.061537 68.246147 58.009225-3.412307 30.710766-30.710766 54.596918-71.658455 61.421533z" fill="" p-id="2179"></path></svg> -->
                    <!-- <svg t="1602918240589" class="icon ml-1 mr-1" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1980" width="25" height="25"><path d="M972.507599 273.292379H17.061537C6.824615 273.292379 0 266.467765 0 256.230843S6.824615 239.169306 17.061537 239.169306h955.446062c10.236922 0 17.061537 6.824615 17.061537 17.061537s-6.824615 17.061537-17.061537 17.061536z" fill="" p-id="1981"></path><path d="M870.138378 478.030821h-3.412307c-10.236922-3.412307-13.649229-10.236922-13.649229-20.473844l51.18461-204.738442c3.412307-10.236922 10.236922-13.649229 20.473844-13.649229 10.236922 3.412307 13.649229 10.236922 13.64923 20.473844l-51.184611 204.738442c-3.412307 6.824615-10.236922 13.649229-17.061537 13.649229zM460.661494 751.015411h-204.738442c-51.18461 0-92.132299-23.886152-102.369221-64.83384L34.123074 259.64315c-3.412307-6.824615 3.412307-17.061537 13.649229-20.473844 6.824615-3.412307 17.061537 3.412307 20.473844 13.649229l119.430758 426.538421c10.236922 34.123074 47.772303 37.535381 68.246147 37.535381h204.738442c10.236922 0 17.061537 6.824615 17.061537 17.061537s-6.824615 17.061537-17.061537 17.061537zM290.046126 273.292379c-3.412307 0-6.824615 0-10.236922-3.412307-6.824615-6.824615-10.236922-17.061537-3.412307-23.886152l170.615368-238.861515c6.824615-6.824615 17.061537-10.236922 23.886152-3.412308 6.824615 6.824615 10.236922 17.061537 3.412307 23.886152l-170.615368 238.861516c-3.412307 3.412307-6.824615 6.824615-13.64923 6.824614zM699.52301 273.292379c-6.824615 0-10.236922-3.412307-13.649229-6.824614l-170.615369-238.861516c-6.824615-6.824615-3.412307-17.061537 3.412308-23.886152 6.824615-6.824615 17.061537-3.412307 23.886151 3.412308l170.615369 238.861515c6.824615 6.824615 3.412307 17.061537-3.412308 23.886152-3.412307 3.412307-6.824615 3.412307-10.236922 3.412307z" fill="" p-id="1982"></path><path d="M767.769157 1024c-139.904602 0-255.923052-116.01845-255.923052-255.923052s116.01845-255.923052 255.923052-255.923053 255.923052 116.01845 255.923053 255.923053-116.01845 255.923052-255.923053 255.923052z m0-477.723031c-122.843065 0-221.799979 98.956914-221.799978 221.799979s98.956914 221.799979 221.799978 221.799978 221.799979-98.956914 221.799979-221.799978-98.956914-221.799979-221.799979-221.799979z" fill="" p-id="1983"></path><path d="M767.769157 870.446169c-44.359996 0-81.895377-23.886152-85.307684-54.596918 0-10.236922 6.824615-17.061537 13.64923-17.061537 10.236922 0 17.061537 6.824615 17.061537 13.649229 0 10.236922 23.886152 23.886152 51.18461 23.886152s51.18461-13.649229 51.184611-27.298459c0-6.824615-10.236922-20.473844-51.184611-23.886152h-3.412307c-23.886152-3.412307-81.895377-13.649229-81.895377-58.009225 0-34.123074 37.535381-61.421533 85.307684-61.421532 44.359996 0 81.895377 23.886152 85.307684 54.596917 0 10.236922-6.824615 17.061537-13.649229 17.061537-10.236922 0-17.061537-6.824615-17.061537-13.649229 0-10.236922-23.886152-23.886152-51.184611-23.886152s-51.18461 13.649229-51.18461 27.298459c0 6.824615 10.236922 20.473844 51.18461 23.886152h3.412308c23.886152 3.412307 81.895377 13.649229 81.895377 58.009225 0 34.123074-37.535381 61.421533-85.307685 61.421533z" fill="" p-id="1984"></path><path d="M767.769157 904.569242c-10.236922 0-17.061537-6.824615-17.061536-17.061537v-238.861515c0-10.236922 6.824615-17.061537 17.061536-17.061537s17.061537 6.824615 17.061537 17.061537v238.861515c0 10.236922-6.824615 17.061537-17.061537 17.061537z" fill="" p-id="1985"></path></svg> -->
                    CheckOut
                </h3>
                </div>
               
            </nav>

            <div class="container">
                <div class="row mt-3">

                    <div class="col-sm-8 m-1">

                        <!-- Shipping Address -- check place -->
                        <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-white rounded">
                            
                            <div class="row border-bottom">
                                <div class="col-9" style="display:inherit"> 
                                    <svg t="1601796482979" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6204" width="19" height="19"><path d="M512 959.469288c-10.69969 0-16.60519-1.283226-20.36584-5.689582-2.261507-2.64934-229.644237-272.535093-290.237267-403.232784-21.890566-46.818305-33.44267-97.655134-33.44267-147.265018 0-187.090049 154.331971-339.226005 344.045777-339.226005s344.045777 153.187915 344.045777 341.429183c0 56.871265-10.660804 99.841939-36.789904 148.300604C747.006362 687.675068 534.795169 950.618713 532.675902 953.24247c-2.532683 3.166109-7.055696 6.227842-20.145829 6.227842L512 959.470311zM512 272.403087c-72.959685 0-132.325771 59.365062-132.325771 132.325771S439.040315 537.054629 512 537.054629s132.325771-59.365062 132.325771-132.325771S584.959685 272.403087 512 272.403087z" p-id="6205" fill="#CD5C5C"></path></svg>
                                    <h5 style="color:#CD5C5C" class="custome-cursor-default">Shipping Address</h5>
                                </div>
                                <div class="col-3 mb-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Change</button>
                                </div>
                            </div>


                            <div class="row mt-2"  id="change-address-result">
                                <?php
                                    if($receipt_name == " "){
                                ?>
                                    <div class="col-sm-12">
                                        <span>No Shipping Address, Please Add New Shipping Address</span>
                                    </div>
                                <?php
                                    }else{
                                ?>
                                    <div class="col-sm-3">
                                        <span id="name"><?php echo $receipt_name;?></span>
                                        <!-- <input type="hidden" name="user" id="inputName" class="custom-input-border custome-cursor-default" value="Mohamand ABCDEF Bin ABCDEF"> -->
                                    </div>
                                    <div class="col-sm-2">
                                        <span id="phone"> <?php echo $recipient_phone ?></span>
                                        <!-- <input type="hidden" name="phoneNumber" id="inputPhone"  class="custom-input-border custome-cursor-default" value=" (+0123456789)"> -->
                                    </div>
                                    <div class="col-sm-6">
                                    <span id="address"><?php echo $recipient_address;?></span>
                                        <!-- <input type="hidden" name="address" id="inputAddress" class="custom-input-border custome-cursor-default" value="No 1 Jalan ABCD Taman ABCD Jalan ABCD ABCDE 12345 Johot Skudai"> -->
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title custome-cursor-default" id="exampleModalLabel" data-toggle="tooltip" title="The address no been save to your account">Change Shipping Address
                                            <svg t="1601799156306" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7713" width="20" height="20">
                                                <path d="M558.656 443.04l-93.12 0c-12.864 0-23.264 10.432-23.264 23.232l0 282.72c0 12.832 10.432 23.232 23.264 23.232l93.12 0c12.864 0 23.264-10.432 23.264-23.232l0-282.72c0.032-12.832-10.4-23.232-23.264-23.232z" p-id="7714" fill="#8a8a8a"></path><path d="M512 0c-282.208 0-512 229.664-512 512.032s229.728 511.968 512 511.968c282.304 0 512-229.6 512-511.968s-229.632-512.032-512-512.032zM511.552 958.912c-246.784 0-447.456-200.768-447.456-447.456 0-246.848 200.704-447.552 447.456-447.552s447.52 200.672 447.52 447.552c0.032 246.72-200.736 447.456-447.52 447.456z" p-id="7715" fill="#8a8a8a"></path><path d="M512.128 250.688c-19.296 0-38.496 7.936-52.16 21.568s-21.6 32.8-21.6 52.064c0 19.264 7.936 38.464 21.6 52.064s32.832 21.568 52.16 21.568 38.496-7.936 52.16-21.568c13.632-13.632 21.6-32.8 21.6-52.064s-7.936-38.464-21.6-52.064c-13.632-13.632-32.832-21.568-52.16-21.568z" p-id="7716" fill="#8a8a8a"></path></svg>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                
                                    <!-- modal content -- Change Address -->
                                    <form method="post" id="change_address">
                                    <div class="modal-body1">
                                        <div class="modal-body">
                                        
                                        <?php 
                                            $userId = $_SESSION['userId'];
                                            if(isset($_SESSION['newShipId'])){
                                                $withoutAddress = $_SESSION['newShipId'];
                                                $thisSql = " and ship_id != '$withoutAddress'";
                                            }else{
                                                $thisSql = " ";
                                            }
                                            
                                            
                                            $userAddress = "select * from address_shipping where user_id = '$userId' ".$thisSql."";
                                            $resultGetUserAddress=$conn->query($userAddress);

                                            if($resultGetUserAddress->num_rows>0){
                                                while($row = $resultGetUserAddress->fetch_assoc()){
                                                    $ri = $row['ship_id'];
                                                    $rn = $row['recipient_name'];
                                                    $rp = $row['recipient_phone'];
                                                    $ra = $row['recipient_address'];
                                                    $rc = $row['recipient_city'];
                                                    $rs= $row['recipient_state'];
                                                    $rpc = $row['recipient_postalCode'];
                                                    $rc = $row['recipient_country'];
                                        ?>
                                            <div class="form-check">
                                                <label class="form-check-label" for="radio1">
                                                    <input type="radio" class="form-check-input" id="normalRadio" name="optradio" value="<?php echo $ri;?>"><?php echo $rn;?>(+60<?php echo $rp?>) <br> <?php echo $ra?>,<?php echo $rc?>,<?php echo $rs ?>,<?php echo $rpc?>,<?php echo $rc?>
                                                </label>
                                            </div>
                                        <?php 
                                                }
                                            }else{

                                            }
                                        ?>

                                            <div class="form-check">
                                                <label class="form-check-label" for="radio2">
                                                    <input type="radio" class="form-check-input" id="createRadio" name="optradio" value="">Create New
                                                </label>
                                            </div>   
                                        </div>                                    

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="check" class="btn btn-primary">Choose</button>
                                        </div>
                                    </div>
                                    <!-- End modal body 1 -->
                                    </form>

                                    <!-- modal 2 hidden -- create new -->
                                    <form id="create_address" method="post" class="needs-validation modal-body2" novalidate>
                                        <div class="modal-body modal-body2">
                                            <div class="form-group">
                                                <label for="uname">name:</label>
                                                <input type="text" class="form-control" id="createName" placeholder="Enter username" name="createName" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pwd">phone no:</label>
                                                    <input type="tel" class="form-control" id="createPhoneNo" onkeypress="return isNumber(event)" placeholder="Enter phone number" name="createPhoneNo" required>
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="createAddress">address:</label>
                                                <input type="text" class="form-control" id="createAddress" placeholder="Enter address" name="createAddress" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="createCity">city:</label>
                                                <select name="createCity" id="createCity" class="custom-select form-control"  onmousedown="if(this.options.length>5){this.size=5;}"  onchange='this.size=0;' onblur="this.size=0;" required>
                                                    <option value="" selected disabled>-- Custom Select Menu --</option>
                                                    <option value="Alor Setar">Alor Setar</option>
                                                    <option value="George Town">George Town</option>
                                                    <option value="Ipoh">Ipoh</option>
                                                    <option value="Iskandar Puteri">Iskandar Puteri</option>
                                                    <option value="Johor Bahru">Johor Bahru</option>
                                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                                    <option value="Kuching">Kuching</option>
                                                    <option value="Kota Kinabalu">Kota Kinabalu</option>
                                                    <option value="Kuala Terengganu">Kuala Terengganu</option>
                                                    <option value="Malacca City">Malacca City</option>
                                                    <option value="Miri">Miri</option>
                                                    <option value="Petaling Jaya">Petaling Jaya</option>
                                                    <option value="Shah Alam">Shah Alam</option>
                                                    <option value="Seberang Perai">Seberang Perai</option>
                                                    <option value="Seremban">Seremban</option>
                                                    <option value="Subang Jaya">Subang Jaya</option>
                                                </select>
                                                    <!-- <input type="tel" class="form-control" id="tel" placeholder="Enter phone number" name="utel" required> -->
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="createState">state:</label>
                                                <select name="createState" id="createState" class="form-control custom-select"  onmousedown="if(this.options.length>5){this.size=5;}"  onchange='this.size=0;' onblur="this.size=0;" required>
                                                    <option value=""  selected disabled>-- Custom Select Menu --</option>
                                                    <option value="Federal Territories">Federal Territories</option>
                                                    <option value="Johor">Johor</option>
                                                    <option value="Kedah">Kedah</option>
                                                    <option value="Malacca">Malacca</option>
                                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                    <option value="Penang">Penang</option>                                
                                                    <option value="Perak">Perak</option>
                                                    <option value="Sarawak">Sarawak</option>
                                                    <option value="Sabah">Sabah</option>
                                                    <option value="Selangor">Selangor</option>
                                                    <option value="Terengganu">Terengganu</option>
                                                </select>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="createPostalCode">Postal Code:</label>
                                                    <input type="number" class="form-control" id="createPostalCode" placeholder="Enter yout postal code" name="createPostalCode" required>
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="createCountry">Country:</label>
                                                <select name="createCountry" id="createCountry" class="custom-select form-control"  required>
                                                    <option value="Malaysia">Malaysia</option>
                                                </select>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="AgreeShip" id="AgressShip" required> I agree on <a href="#"> Shipping & Return Argeement</a>.
                                                    <div class="valid-feedback">Valid.</div>
                                                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="goback">Go Back</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="createBtn" id="createBtn" value="createBtn" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                    <!-- End Modal2 -->

                                    
                                    </div> 
                                    <!-- End modal content -->
                                </div>
                                <!-- End modal dialog -->
                            </div>
                            <!-- End Modal -->
                        
                        </div>
                        <!-- End shipping Address -- check place -->

                        <!-- Check Out -- Producy place -->
                        <div class="col-12 mt-2 bg-white p-3 shadow-sm p-3 mb-5 bg-white rounded">
                            <div class="row">
                                <div class="col"><h5 class="font-weight-bold"> No </h5></div>
                                <div class="col"><h5 class="font-weight-bold"> Product </h5></div>
                                <div class="col"><h5 class="font-weight-bold"> Qty </h5></div>
                                <div class="col"><h5 class="font-weight-bold" data-toggle="tooltip" title="Total Each Product"> Total Price 
                                    <svg t="1601799156306" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7713" width="20" height="20">
                                    <path d="M558.656 443.04l-93.12 0c-12.864 0-23.264 10.432-23.264 23.232l0 282.72c0 12.832 10.432 23.232 23.264 23.232l93.12 0c12.864 0 23.264-10.432 23.264-23.232l0-282.72c0.032-12.832-10.4-23.232-23.264-23.232z" p-id="7714" fill="#8a8a8a"></path><path d="M512 0c-282.208 0-512 229.664-512 512.032s229.728 511.968 512 511.968c282.304 0 512-229.6 512-511.968s-229.632-512.032-512-512.032zM511.552 958.912c-246.784 0-447.456-200.768-447.456-447.456 0-246.848 200.704-447.552 447.456-447.552s447.52 200.672 447.52 447.552c0.032 246.72-200.736 447.456-447.52 447.456z" p-id="7715" fill="#8a8a8a"></path><path d="M512.128 250.688c-19.296 0-38.496 7.936-52.16 21.568s-21.6 32.8-21.6 52.064c0 19.264 7.936 38.464 21.6 52.064s32.832 21.568 52.16 21.568 38.496-7.936 52.16-21.568c13.632-13.632 21.6-32.8 21.6-52.064s-7.936-38.464-21.6-52.064c-13.632-13.632-32.832-21.568-52.16-21.568z" p-id="7716" fill="#8a8a8a"></path></svg>
                                </h5></div>
                            </div>

                            <?php 
                                $_SESSION['i'] = 0;
                                $_SESSION['subtotal'] = 0;
                                $_SESSION['SubShipTotal'] = 0;
                                $_SESSION['Total'] = 0;
                                $_SESSION['UnifiedDelivery'] = '';
                                $discount = '10%';

                                if($_GET['cartId']){
                                    $cartId = $_GET['cartId'];
                                    $getProduct = "select cartintegration.*, product.*,cart.unifiedDelivery from cart left join cartintegration on cart.cartId = cartintegration.cartId LEFT JOIN product on cartintegration.productId = product.id where cartintegration.cartId = '$cartId' AND cartintegration.status = ''";
                                    $resultGetProduct = $conn->query($getProduct);
                                
                                    if($resultGetProduct->num_rows > 0){ //over 1 database(record) so run
                                        while($row = $resultGetProduct->fetch_assoc()){
                                            $ProductCartIntegrationId = $row['cartIntegrationId'];
                                            $ProductCartId = $row['cartId'];
                                            $ProductId = $row['productId'];
                                            $ProductVariation = $row['variation'];
                                            $ProductQuantity = $row['quantity'];
                                            $ProductName = $row['name'];
                                            $ProductPrice = $row['price'];
                                            $ProductImage = $row['coverImage'];
                                            $_SESSION['UnifiedDelivery'] = $row['unifiedDelivery'];
                                            
                                            $_SESSION['i']++;
                                            $_SESSION['subtotal'] = $_SESSION['subtotal'] + $ProductPrice; // subtotal product price
                                            $ProductSubPrice = $ProductPrice + 5; // subtotal foreach product price & shipping fee
                                            $_SESSION['SubShipTotal'] = $_SESSION['i'] * 5; // calculate all product shipping fee
                                            
                            ?>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <img src="../images/productImage/<?php echo $ProductImage;?>" class="mr-1" alt="..." width="100">
                                </div>
                                <div class="col">
                                    <div class="row"><?php echo $ProductName;?></div>
                                    <div class="row">Variation : ( <b><?php echo $ProductVariation;?></b> )</div>
                                </div>
                                <div class="col">x <b><?php echo $ProductQuantity;?></b></div>
                                <div class="col"><?php echo $ProductPrice;?></div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3 font-weight-bold">Shipping Fee :</div>
                                <div class="col-3 ">Masamon Express Companies</div>
                                <div class="col-3 ">RM 5.00</div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3 font-weight-bold">SubTotal :</div>
                                <div class="col-3 font-weight-bold">RM <?php echo $ProductSubPrice;?></div>
                            </div>
                            <?php
                                        }
                                    }else{
                                        header("Location: ../user/purchasePage.php");
                                        die();
                                    }
                                }

                                if($_SESSION['UnifiedDelivery'] == '0'){
                                    $AfterDiscount10 = $_SESSION['SubShipTotal'] * 0.1; //calculate subtotal shipping fee * 10%
                                    $calAfterDiscountItem = $AfterDiscount10 * $_SESSION['i'];//calculate after10% * order item
                                    $_SESSION['DiscountUifiedDelivery'] = $calAfterDiscountItem;
                                    $_SESSION['Total'] = $_SESSION['subtotal'] + $_SESSION['SubShipTotal'] - $calAfterDiscountItem; //caulculate after discount subtotal Shipping fee
                                
                                }else if($_SESSION['UnifiedDelivery'] == '1'){
                                    $_SESSION['DiscountUifiedDelivery'] = " ";
                                    $_SESSION['Total'] = $_SESSION['subtotal'] + $_SESSION['SubShipTotal'];
                                }
                                
                            ?>
                            <!-- Product Two -->
                            <!-- <hr>
                            <div class="row">
                                <div class="col">
                                    <img src="../images/productImage/A001.jpg" class="mr-1" alt="..." width="100">
                                </div>
                                <div class="col">
                                    <div class="row">Product Name</div>
                                    <div class="row">Variation : ()</div>
                                </div>
                                <div class="col">x <b>1</b></div>
                                <div class="col">price</div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3 font-weight-bold">Shipping Fee :</div>
                                <div class="col-3 ">Masamon Express Companies</div>
                                <div class="col-3 ">RM xx.xx</div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-3 font-weight-bold">SubTotal :</div>
                                <div class="col-3 font-weight-bold">RM xx.xx</div>
                            </div> -->
                        </div>
                       <!-- <hr/>  For next Product -->
                        <!-- End Check Out -- Product Place -->

                    </div>
                    <!-- End left check out box -->


                    <form method="post" id="PlaceOrderForm">
                    <!-- Right Total Price Box -->
                    <div class="col-md-12 mt-1 ml-3 mr-3 ">
                        <div class="card shadow-sm mb-5 rounded">
                            <div class="card-header text-center font-weight-bold">
                                Order Summary
                            </div>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Order Item
                                        <span class="badge badge-primary badge-pill"><?php echo $_SESSION['i'];?></span>
                                        <input type="hidden" name="OrderItem" value="<?php echo $_SESSION['i'];?>">
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Subtotal
                                        <span class="badge badge-primary badge-pill">RM <?php echo $_SESSION['subtotal'];?></span>
                                        <input type="hidden" name="Subtotal" value="<?php echo $_SESSION['subtotal'];?>">
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Subtotal(Shipping Fee)
                                        <span class="badge badge-primary badge-pill">RM <?php echo $_SESSION['SubShipTotal'];?></span>
                                        <input type="hidden" name="SubShipFee" value="<?php echo $_SESSION['SubShipTotal'];?>">
                                    </li>
                                    <?php if($_SESSION['UnifiedDelivery'] == '0'){ ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Discount UnifiedDelivery -<?php echo $discount;?>
                                            <span class="badge badge-primary badge-pill">RM <?php echo $_SESSION['DiscountUifiedDelivery'];?></span>
                                            <input type="hidden" name="DiscountDelivery" value="<?php echo $_SESSION['DiscountUnifiedDelivery'];?>">
                                        </li>
                                    <?php } ?>                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Price
                                        <span class="badge badge-primary badge-pill">RM <?php echo $_SESSION['Total'] ?></span>
                                        <input type="hidden" name="totalAmount" value="<?php echo $_SESSION['Total']; ?>">
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Payment Method
                                        <select name="PaymentMethod" id="PaymentMethod" class="form-control">
                                            <option selected disabled value="">Choose...</option>
                                            <option value="CashOnDelivery">Cash On Delivery</option>
                                            <option value="Paypal">Paypal</option>
                                        </select>
                                    </li>
                                </ul>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary btn-block" onclick="PlaceOrderBtn()">
                                    <svg t="1602919978696" class="icon pb-1" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5023" width="25" height="25"><path d="M853.333333 170.666667l-682.666667 0c-47.146667 0-84.906667 38.186667-84.906667 85.333333l-0.426667 512c0 47.146667 38.186667 85.333333 85.333333 85.333333l682.666667 0c47.146667 0 85.333333-38.186667 85.333333-85.333333l0-512c0-47.146667-38.186667-85.333333-85.333333-85.333333zM853.333333 768l-682.666667 0 0-256 682.666667 0 0 256zM853.333333 341.333333l-682.666667 0 0-85.333333 682.666667 0 0 85.333333z" p-id="5024" fill="#ffffff"></path></svg>
                                    Place Order
                                </button>
                                <button type="button" class="btn btn-danger btn-block gobackButton">
                                <svg t="1603187015231" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5287" width="20" height="20"><path d="M557.25 512l297.38-297.37a32 32 0 0 0-45.25-45.25L512 466.75 214.63 169.38a32 32 0 0 0-45.25 45.25L466.75 512 169.38 809.38a32 32 0 1 0 45.25 45.25L512 557.25l297.38 297.38a32 32 0 0 0 45.25-45.25z" fill="#ffffff" p-id="5288"></path></svg>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div><!-- End Right Total Price Box-->
                    </form>


                </div><!-- End row -->
            </div><!-- End container -->

        </div><!-- End Main Content -->

    </div><!-- End Content Wrapper -->
    <?php 
    if(isset($_SESSION['m'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
    <?php } ?>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script><!-- Sweet Alert JS  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="../js/formValid.js"></script>

<script>
    //change new address modal radio button check 
    $("#check").click(function(){
        if ($('#createRadio').is(':checked')) { //create checked
            $('.modal-body1').hide();
            $('.modal-body2').show();

            $("#goback").click(function(){
                $('.modal-body2').hide();
                $('.modal-body1').show();
            });
                        
            
        }else {
            var ChangAddressName = document.getElementsByName("optradio");
            //check where checkbox is click
            for(i = 0; i < ChangAddressName.length; i++) { 
                if(ChangAddressName[i].checked){
                    if(ChangAddressName[i].checked != " "){
                        console.log(ChangAddressName[i].value);
                        var NewShipIdValue = ChangAddressName[i].value;

                        $.ajax({  
                        url:"../database/user/insert-shipping-addresss.php",  
                        method:"POST",  
                        data:{
                            newShipId:NewShipIdValue,
                        }, 
                        success:function(data)
                        {  
                            location.reload();                          
                        }  
                        });
                    }
                }
            }
        }
      
    });

    //create new ship address
    $("#createBtn").click(function(){

        //check agree ship agreement
        if($('#AgressShip').is(':checked')) {
                // $('#create_address').on("submit", function(event){  
                // event.preventDefault(); 
                    var name = $('#createName').val();
                    var phone = $('#createPhoneNo').val();
                    var address = $('#createAddress').val();
                    var city = $('#createCity').val();
                    var state = $('#createState').val();
                    var postal = $('#createPostalCode').val();
                    var country = $('#createCountry').val();

                    // console.log(name+','+phone+','+address+','+city+','+state+','+postal+','+country);

                    // var data = $('#create_address').serialize()+'$createBtn=createBtn';
                    $.ajax({  
                        url:"../database/user/insert-shipping-addresss.php",  
                        method:"POST",  
                        data:{
                            createName:name,
                            createPhoneNo:phone,
                            createAddress:address,
                            createCity:city,
                            createState:state,
                            createPostalCode:postal,
                            createCountry:country
                        }, 
                        success:function(data)
                        {  
                            $('#change-address-result').html(data); 
                            // console.log(data.name+','+data.phone+','+data.address+','+data.city+','+data.state+','+data.postal+','+data.country);
                            // $('#change-address-result').replaceWith(data);
                            // $('#inputName').val(data.name);  
                            // $('#inputPhone').val(data.phone);  
                            // $('#inputAddress').val(data.address);  
                            // $('#designation').val(data.city);  
                            // $('#age').val(data.State);  
                            // $('#employee_id').val(data.postalCode);
                            // $().val(data.country); 
                            // $('#create_address')[0].reset();  
                            $('.modal-body2').modal('hide');  
                            location.reload();

                            
                        }  
                    });
                // }); 
        }
    });

    //cancel double confirm effect
    $(".gobackButton").click(function(){
        Swal.fire({
        title: 'Are you sure want cancel order?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "http://localhost/testProject/database/user/cancelCheckOut.php";
        }
        })
    });

    //sweet alert effect
    var flashdata = $('.flash-data').data('flashdata')
        if(flashdata == "creted-address-success-01"){
            Swal.fire(
                'Change Successful!',
                'Your change the new ship address!',
                'success'
            )
        }else if(flashdata == "creted-address-success-02"){
            Swal.fire(
                'Change Successful!',
                'Your change the new ship address!',
                'success'
            )
        }else if(flashdata == "Place-Order-Failed-01"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
            })
        }else if(flashdata == "Place-Order-Failed-NoShipAddress-01"){
            Swal.fire({
                icon: 'error',
                title: 'Oops... No Fill Shipping Address',
                text: 'Please Fill In Shipping Address & Continue Place Order!',
                footer: '<a href>Why do I have this issue?</a>'
            })
        }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    //payment parts
    function PlaceOrderBtn() {
        // if( $('#PaymentMethod').val() != " ") {
        //     Swal.fire({
        //         title: 'Are you confirm place order ?',
        //         text: "Make sure all information is correct!",
        //         icon: 'info',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, Place Order!'
        //         }).then((result) => {
        //         if (result.isConfirmed) {
        //             document.getElementById("PlaceOrderForm").action = "../database/user/PlaceOrder.php";
        //             document.getElementById("PlaceOrderForm").submit();
        //         }
        //     })
        if( $('#PaymentMethod').val() == "Paypal") {
            Swal.fire({
                title: 'Are you confirm place order ?',
                text: "Make sure all information is correct!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Place Order!'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("PlaceOrderForm").action = "../database/user/PlaceOrder.php";
                    document.getElementById("PlaceOrderForm").submit();
                }
            })
        }else if( $('#PaymentMethod').val() == "CashOnDelivery"){
            Swal.fire({
                title: 'Are you confirm place order ?',
                text: "Make sure all information is correct!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Place Order!'
                }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("PlaceOrderForm").action = "../database/user/PlaceOrder.php";
                    document.getElementById("PlaceOrderForm").submit();
                }
            })
        }else{
            Swal.fire(
                'Unselect Payment Method !',
                'Please Retry And Order Again ...',
                'question'
            )
        }
        
    }


    // var ChangAddressName = document.getElementsByName("oldoptradio");
    // $("#normalRadio").click(function (){
    //     console.log($("normalRadio").val());
    // });
</script>
</html>