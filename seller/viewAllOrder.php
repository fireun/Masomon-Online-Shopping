<?php

    include '../config.php';
    session_start();

    if(isset($_SESSION['sellerId'])){
        $sellerId = $_SESSION['sellerId'];
        $productSQL = "select * from product where sellerId = '$sellerId' and  auctionStatus = 'no'";
        $productResult = $conn->query($productSQL);
        if($productResult->num_rows > 0){ //over 1 database(record) so run
            while($row = $productResult->fetch_assoc()){
                $productId=$row['id'];
                $_SESSION['productId']=$productId;
                $productName = $row['name'];
                $productPrice=$row['price'];  
                $productDescription = $row['description'];
                $productCoverImage=$row['coverImage'];  
                $productColor = $row['color'];
                $productBrand=$row['brand'];  
                $productMaterial = $row['material'];
                $productGender=$row['gender'];  
                $productSoldRecord = $row['soldRecord'];

                // id
                $productInventoryId=$row['InventoryId'];  
                $productCategoryId = $row['categoryId'];
                $productAuctionStatus=$row['auctionStatus'];  
                $productAuctionId = $row['auctionId'];
                $productAuctionDueDate=$row['auctionDueDate'];  
                $productImageId = $row['imagesId'];
                $productUploadTime=$row['uploadTime']; 
            }
        }
    
        $deleteMessage = " ";
        if(isset($_POST['delete'])){
            if(empty($_REQUEST['item'])){ //No item checked
                $deleteMessage= "You must click delete product";
                echo'<script type=text/javascript>window.alert("No Confirm delete")</script> ';
            }else{
                foreach($_REQUEST['item'] as $deleteId){
                    $deleteMessage = $deleteId;
                    //delete the item with the username
                    $productsql="delete from product where id='$deleteId'";
                    $imagesql="delete from images where productId='$deleteId'";
                    $variation="delete from variation where productId='$deleteId'";
                    $inventory="delete from inventory where productId='$deleteId'";

                    //run sql
                    $result=$conn->query($productsql);
                    $result1=$conn->query($imagesql);
                    $result2=$conn->query($variation);
                    $result3=$conn->query($inventory);
                }
                
                if($result && $result1 && $result2 && $result3 === true){
                    echo'<script type=text/javascript>window.alert("Delete Succcefful")</script> ';
                }else{
                    echo'<script type=text/javascript>window.alert("Delete Failure")</script> ';
                }
                
            } 
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View All Order</title>
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/sellerstyle.css" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/profilestyle.css">
    <link rel="stylesheet" type="text/css" href="../css/viewstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/tablestyle.css">
    <link rel="stylesheet" type="text/css" href="../css/orderList.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
     <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!------ Include the above in your HEAD tag ---------->

    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
</head>
<body>
    <?php require 'header.php' ?>

    <div class="content" style="height: 500px;">
        <?php require 'asideLeft.php' ?>

        <aside class="contentbar"> 
        
        </aside>
    </div>
    <?php require 'footer.php' ?>
</body>
    <script src="../js/sellerscript.js"></script>
    <script src="../js/orderListscript.js"></script>
    <script>
        function openModal(){
            // //Modal box
            var modal = document.getElementById("deleteModal");
            modal.style.display = "block";

            // // Get the cancel button that opens the modal
            var cancelbtn = document.getElementById("cancelDelete");

            //Get the close button
            var closedbtn = document.getElementById("closebtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            // btn.onclick = function() {
            //     modal.style.display = "block";
            // }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            cancelbtn.onclick = function() {
                modal.style.display = "none";
            }

            closedbtn.onclick = function() {
                modal.style.display = "none";
            }


            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }


    </script>
</html>