<?php
include("../config.php");
include '../limitTimeSession.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");// current year-month-days hours:minut:seconts

// if(isset($_SESSION['username'])){
//     $user=$_SESSION['username'];
//     $userId=$_SESSION['userId'];

//     if(isset($_POST['remove'])){
//        $dID = $_POST['deleteId'];
//        $remover="delete from cartintegration where cartIntegrationId = '$dID' and userId='$userId' and cartId = ''";
//        $removerResult=$conn->query($remover);
        
//        if($removerResult == true){
//             echo '<script>window.alert("Product Is Remove from Cart")</script>';
//             header('refresh:0.5;url=../user/cart.php');
//        }else{
//             echo '<script>window.alert("Failed to Remover Cart")</script>';
//        }
//      }
//   }else{
//     echo "<script>alert('must login first');
//         window.location.href= '../user/login.php';</script>";
// }

// if(isset($_POST['update'])){
//     $user=$_SESSION['username'];
//     $userId=$_SESSION['userId'];
//     $EditVariation = $_POST['editVariation'];
//     $EditQuantity = $_POST['editQuantity'];
//     $EditCart = $_POST['EditCartIntegrationId'];
   
//     if(empty($EditQuantity)){
//         echo '<script>window.alert("Quantity Empty")</script>';
//     }else if(empty($EditCart)){
//         echo '<script>window.alert("unvalid cart id")</script>';
//     }else{
//         echo $UpdateCart = "update cartintegration set variation = '$EditVariation', quantity = '$EditQuantity' where cartIntegrationId ='$EditCart'";
//         $resultUpdate = $conn->query($UpdateCart);
//         if($resultUpdate == true){
//             echo '<script>window.alert("Update Success")</script>';
//         }else{
//             echo '<script>window.alert("Update Failed")</script>';
//         }
//     }
// }


// if(isset($_POST['checkout'])){  
//     $generateCartId = uniqid();
//     $totalPrice = $_POST['totalPrice'];
//     $unifiedDelivery = '';
//     $userId = $_SESSION['userId'];

//     if(empty($_POST['cartIntegrationID'])){ //No item checked
//         echo'<script type=text/javascript>window.alert("No Fill Product Size")</script> ';
//     }else{
//         foreach($_POST['cartIntegrationID'] as $UpdateCartID){

//             $update= "update cartintegration set cartId = '$generateCartId' where cartIntegrationId = '$UpdateCartID'";

//             //run sql
//             $updateresult=$conn->query($update);
//         }

//         if( empty($_POST["unifiedDelivery"]) ){ 
//         $unifiedDelivery = 1 ; //disagree
//         }else { 
//             $unifiedDelivery = 0; //agree
//         }

//         $in_ch=mysqli_query($conn,"insert into cart(cartId,userId,total,unifiedDelivery) values ('$generateCartId','$userId','$totalPrice','$unifiedDelivery')");  

//         if($in_ch==1 && $updateresult == 1){  
//             echo'<script>alert("Inserted Successfully")</script>';  
//         }else {  
//             echo'<script>alert("Failed To Insert")</script>';  
//         }  
//     }
// }  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="Cart.css"> -->
        <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
        <title>Cart</title>
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/homestyle.css">

        <!-- set  checkout cannot click browser go back -->
        <script type = "text/javascript" >
            function preventBack(){window.history.forward();}
            setTimeout("preventBack()", 0);
            window.onunload=function(){null};
        </script>
        
        <style>  

            .quantity {
                float: left;
                margin-right: 15px;
                background-color: #eee;
                position: relative;
                width: 80px;
                overflow: hidden
            }

            .quantity input {
                margin: 0;
                text-align: center;
                width: 15px;
                height: 15px;
                padding: 0;
                float: right;
                color: #000;
                font-size: 20px;
                border: 0;
                outline: 0;
                background-color: #F6F6F6
            }

            .quantity input.qty {
                position: relative;
                border: 0;
                width: 100%;
                height: 40px;
                padding: 10px;
                text-align: center;
                font-weight: 400;
                font-size: 15px;
                border-radius: 0;
                background-clip: padding-box
            }

            .quantity .minus, .quantity .plus {
                line-height: 0;
                background-clip: padding-box;
                -webkit-border-radius: 0;
                -moz-border-radius: 0;
                border-radius: 0;
                -webkit-background-size: 6px 30px;
                -moz-background-size: 6px 30px;
                color: black;
                font-size: 20px;
                position: absolute;
                height: 50%;
                border: 0;
                right: 0;
                padding: 0;
                width: 25px;
                z-index: 3
            }

            .quantity .minus:hover, .quantity .plus:hover {
                background-color: #cd5c5c;
                color:white;
            }

            .quantity .minus {
                bottom: 0
            }
            .shopping-cart {
                position:relative;
                /* top:124px; */
            }
            .card-header {
                font-size:20px;
            }
            .action-mode{
                display:inline-table;
            }

            /* The Modal (background) */
            .editmodal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: hidden; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content/Box */
            .editmodal-content {
                background-color: #fefefe;
                margin: 10% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 50%;
            }

            /* The Close Button */
            .editmodal-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            }

            .editmodal-close:hover,
            .editmodal-close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
            }

            .edit-modal-header {
                border-bottom: 1px solid black;
                /* margin-bottom: 8%; */
                width: 77%;
            }

            .mobile-edit-mode-btn {
                width:83%;
                outline:auto;
            }
            @media screen and (max-width:800px){
                /* .shopping-cart {top:96px;} */
                .action-mode {display: inline-block;margin: 0% 0% 0% 3%;}
                .editmodal-content {
                    background-color: #fefefe;
                    margin: 15% auto; /* 15% from the top and centered */
                    padding: 20px;
                    border: 1px solid #888;
                    width: 80%; /* Could be more or less, depending on screen size */
                }
                .edit-modal-header {margin-bottom:8px;}
                
            }

            @media screen and (max-height:800px){
                .card-footer {margin-top:5%}
            }

        </style>
    </head>
    <body>
        
        <!-- Top Nav Bar -->
        <?php require '../user/subheader.php' ?>
        <!-- End Top NavBar -->
       
        <div class="shopping-cart-container mt-5">            
            <div class="card shopping-cart border-bottom-0">
                     <div class="card-header text-black">
                         <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                         Shopping cart
                         <a href="../user/home.php" class="btn btn-outline-danger text-body btn-sm pull-right">Continue shopping</a>
                         <div class="clearfix"></div>
                     </div>
                     <form action="../database/user/checkout.php" method="post">
                     <div class="card-body"  style="overflow: hidden;margin-bottom: 5%">
                            <?php
                            $_SESSION['countCart'] = 0;
                            if(isset($_SESSION['username'])){
                                $userId = $_SESSION['userId'];
                                $getCart = "select * from cartintegration left join product on cartintegration.productId = product.id LEFT JOIN inventory on cartintegration.productId = inventory.productId where cartintegration.userId = '$userId' and cartintegration.cartId = ''";
                                $resultGetCart = $conn->query($getCart);
                                if($resultGetCart->num_rows > 0){ //over 1 database(record) so run
                                    while($row = $resultGetCart->fetch_assoc()){
                                        $CartIntegrationId = $row['cartIntegrationId'];
                                        $CartId= $row['cartId'];
                                        $CartProductId = $row['productId'];
                                        $CartVariation = $row['variation'];
                                        $CartQuantity = $row['quantity'];
                                        $CartProductName = $row['name'];
                                        $CartProductPrice = $row['price'];
                                        $CartProductImage = $row['coverImage'];
                                        $CartProductColor = $row['color'];
                                        $CartProductInventoryId = $row['inventoryId'];
                                        $CartProductTotalStock = $row['totalStock'];
                                        $CartProductStock = $row['stock'];
                                        $CartProductSpaceInventory = $row['spaceInventory'];
                                        $CartDetentionPeriod = $row['detentionPeriod'];

                                        $_SESSION['countCart']+=1;
                                        if( ($CartDetentionPeriod == "0000-00-00 00:00:00") || ($CartDetentionPeriod >= $date)){
                                
                            ?>
                             <!-- PRODUCT -->
                             <div class="row" id="product">
                                 <div class=" col-sm-2 col-md-2 text-center">
                                        <input type="checkbox" name="cartIntegrationID[]" class="checks checkBox" id="productid" value="<?php echo $CartIntegrationId;?>"  data-price="<?php echo $CartProductPrice*$CartQuantity?>">
                                         <img class="img-responsive" src="../images/productImage/<?php echo $CartProductImage;?>" alt="prewiew" width="100" height="90">
                                 </div>
                                 <div class=" text-sm-center col-sm-3 text-md-left col-md-4">
                                     <h4 class="product-name pt-2 pl-4"><strong><?php echo $CartProductName;?></strong></h4>
                                     <h4 class="product-name pl-4"><strong>Variation:  <?php echo $CartVariation;?></strong></h4>
                                     
                                     <?php 
                                        if($CartDetentionPeriod != "0000-00-00 00:00:00"){
                                     ?>
                                        <h4 class="product-name pl-4"><strong>limit purchse before:  <?php echo $CartDetentionPeriod;?></strong></h4>
                                     <?php
                                        }
                                     ?>

                                 </div>
                                 <div class=" col-sm-7 text-sm-center col-md-6 text-md-right row ml-2">
                                     <div class=" col-sm-5 col-md-6" style="padding-top: 5px">
                                         <h6><strong>Unit Price: <?php echo $CartProductPrice ?></strong></h6>
                                         <h6><strong>RM <?php echo $CartProductPrice*$CartQuantity ?>    <span class="text-muted">x</span></strong></h6>
                                     </div>
                                     <div class=" col-sm-4 col-md-4">
                                         <div class="quantity">
                                             <!-- <input type="button" value="+" class="plus"> -->
                                             <input type="text" value="<?php echo $CartQuantity; ?>" title="Quantity" class="qty"
                                                    size="<?php echo $CartProductStock;?>" readonly/>
                                             <!-- <input type="button" value="-" class="minus"> -->
                                         </div>
                                     </div>
                                     <div class=" col-sm-2 col-md-2 text-right action-mode">
                                        <button type="button" class="btn btn-outline-danger btn-xs" id="<?php echo $CartIntegrationId?>" title="Edit Cart" onclick="editModal(this)">
                                             <i class="fa fas fa-edit" aria-hidden="true"></i>
                                         </button>
                                         <!-- <button type="submit" value="<?php echo $CartIntegrationId;?>" class="btn btn-outline-danger btn-xs" title="Remover Item" >
                                             <i class="fa fa-trash" aria-hidden="true"></i>
                                         </button> -->
                                     </div>
                                 </div>
                             </div>
                             <hr>
                             <!-- END PRODUCT -->
                             
                           
                            <?php 
                                        }else if( ($CartDetentionPeriod != "0000-00-00 00:00:00") && ($CartDetentionPeriod <= $date) ){
                                                        
                                        }
                                        }//end while 
                                    }else{ 
                            ?>
                                    <div style="text-align:center;margin-top:10%">
                                        <h2>Empty Cart</h2>
                                        <a href="../user/home.php">Go to Shopping</a>
                                    </div>
                                    
                            <?php
                                    }
                                
                                }else{
                                    echo "<script>alert('must login first');
                                        window.location.href= '../user/login.php';</script>";
                                }
                            ?>
                     </div>
                     <div class="card-footer" style="height: 72px; position: fixed;height: 100px;bottom: 0;width: 100%;background-color:#f2f2f2">
                        <div class="pull-left mt-3 ml-4">
                            <div>
                                <input type="checkbox" name="CheckAll" id="checkAll" onclick="toggle(this);">
                                <label class="form-check-label">SELECT ALL (<?php echo $_SESSION['countCart'];?> ITEM(S))</label>
                                <button type="submit" name="remove" value="<?php echo $CartIntegrationId;?>" class="btn btn-danger btn-xs ml-2" title="Remover Item" > Remove </button>
                            </div>
                        </div>
                         <div class="pull-right" style="margin: 10px">
                                <div class="row">
                                <div class="form-check">
                                    <input type="checkbox" name="unifiedDelivery" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">I <b>agree </b><a href="#">Unifired Delivery</a> to this order</label>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="pull-right" style="margin: 5px">
                                        <?php
                                        $countTotal = "SELECT SUM(product.price*cartintegration.quantity) AS total FROM cartintegration left JOIN product on cartintegration.productId = product.id WHERE cartintegration.userId = '$userId'";
                                        $countTotalResult = $conn->query($countTotal);
                                        if($countTotalResult->num_rows > 0){ //over 1 database(record) so run
                                            while($row = $countTotalResult->fetch_assoc()){
                                                $totalPrice = $row['total'];
                                            }
                                        }
                                        ?>
                                        <span class="pt-2 pr-2"> Total price:RM<b id="tots" class="pl-1"> <?php echo $totalPrice;?></b></span> 
                                        <input type="hidden" name="totalPrice" id="totalPriceValue" value="">
                                        <button type="submit" name="checkout" class="btn btn-success pull-right" id="CheckBtn">Checkout</button>
                                        <!-- <a href="CheckOut.php" class="btn btn-success pull-right">Checkout</a> -->

                                    </div>
                                </div>                             
                         </div>
                         <!-- End pull right box place -->
                     </div>
                 </div>
                 </form>
                 </div>
         </div>

    <form action="../database/user/checkout.php" method="post">
        <!--The Edit Modal-->
        <div id="editModal" class="editmodal">

        <!--Modal content-->
        <div class="editmodal-content">
            <span class="editmodal-close">&times;</span>
            <div class="col-md-12" style="margin: 6%;">
                <div class="row edit-modal-header">
                    <h3>Edit</h3>
                    </hr>
                </div>
                <div style="padding:5%" id="contentUpdateModal">
                    
                </div>
                
            </div>                                
        </div>

        </div> <!--End Edit Modal-->
        
    </form>

    <?php 
    if(isset($_SESSION['m'])){ ?>
    <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
    <?php } ?>

        <!------ Include the above in your HEAD tag ---------->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://use.fontawesome.com/c560c025cf.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
         <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->
        <!-- <script src="../js/homescript.js"></script>
        <script src="../js/userProductDetail.js"></script> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
        <!--Ajaxx-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <!-- Sweet Alert JS  -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   
        <script>

        // implements checked All checkbox
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
            document.getElementById('exampleCheck1').checked = false;
            recalculate();
        }

        // cal total with checked checkbox
        function recalculate(){
            var sum = 0;

            $("#product input[type=checkbox]:checked").each(function(){
                sum += parseInt($(this).attr("data-price"));
            });

            $('#tots').text(sum.toFixed(2));
            document.getElementById("totalPriceValue").value = sum.toFixed(2);
        }

        function calc() {
            var tots = 0;
            $(".checks:checked").each(function() {
                var price = $(this).attr("data-price");
                tots += parseFloat(price);
                });
                $('#tots').text(tots.toFixed(2));
                document.getElementById("totalPriceValue").value = tots.toFixed(2);
        }

        $(function() {
            $(document).on("change", ".checks", calc);
            calc();
        });

        // function removeProduct(cartIntegrationId){
        //     var id = $(cartIntegrationId).val();
        //     var a = "remove";
        //     $.ajax({
        //         url:"../database/user/checkout.php",
        //         method:"POST",
        //         data:{
        //           productId:id,
        //           action:a
        //         }, //this is what data send between hyperlink
        //         success:function(data)
        //         {
        //             //$('#StockContent').html(data); //show in this dynaimic_content place
        //         }
        //     });  
        // }




        // Get the modal
        var Editmodal = document.getElementById("editModal");
        // Get the button that opens the modal
        // var btn = document.getElementById("myBtn");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("editmodal-close")[0];
        // When the user clicks on the button, open the modal

        function editModal(CartIntegration) {
            Editmodal.style.display = "block";
            // var id = document.getElementById('editID').getAttribute('data-id');//get cart integration id
            // document.getElementById('showCartIntegrationId').innerHTML = id;
            // console.log($('#showCartIntegrationId').val(id));
            // var id = $(this).attr('data-id');
            // console.log(CartIntegration.id);
            $('#showCartIntegrationId').val(CartIntegration.id);
            // alert($(this).attr("#data-id"));
            // $('#showCartIntegrationId').innerHTML = $(this).data('id');
            // document.getElementById('showCartIntegrationId').val(CartIntegrationId);
            var id = CartIntegration.id;

             $.ajax({  
                        url:"../database/user/cart.php",  
                        method:"POST",  
                        data:{
                            action:"updateCart",
                            cartIntegrationId:id
                        }, 
                        success:function(data)
                        {  
                            $('#contentUpdateModal').html(data);
                        }  
                    });
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            Editmodal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == Editmodal) {
                Editmodal.style.display = "none";
            }
        }


        var flashdata = $('.flash-data').data('flashdata')
         if(flashdata == "SomethingError404-COE-C2-DE"){
            Swal.fire({
                icon: 'error',
                title: 'Failed Check Out!',
                text: 'The action is Error, Please Try Later...',
                footer: '<a href>Why do I have this issue?</a>'
            })
         }else if(flashdata == "Delect-Cart-2-Failed-2Notif"){
            Swal.fire({
                icon: 'error',
                title: 'Remover Failed!',
                text: 'The action is Error, Please Try Later...',
                footer: '<a href>Why do I have this issue?</a>'
            })
         }else if(flashdata == "SomethingError404-COE-C1-UCK"){
            Swal.fire({
                icon: 'error',
                title: 'No Checked Product!',
                text: ' Please checked the product your want ...',
                footer: '<a href>Why do I have this issue?</a>'
            })
         }else if(flashdata == "Delect-Cart-1-Success-1Notif"){
            Swal.fire(
                'Remover Success!',
                'The item is remover from the cart!',
                'success'
                )
         }else if(flashdata == "Upload-Cart-Qty-Success-1Notif"){
            Swal.fire(
                'Update Success!',
                'Clicked the button to continue!',
                'success'
                )
         }else if(flashdata == "Upload-Cart-Qty-Failed-1Notif"){
            Swal.fire({
                icon: 'error',
                title: 'Failed Update Quantity!',
                text: 'The action is Error, Please Try Later...',
                footer: '<a href>Why do I have this issue?</a>'
            })
         }else if(flashdata == " Add-To-Cart-Success-1Notif"){
            Swal.fire(
                'Add To Success!',
                'Clicked the button to continue!',
                'success'
                )
         }

        
        </script>
    </body>
</html>