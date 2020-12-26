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
    <title>view product</title>
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
        <form action="viewProduct.php" method="post">
			<div class="container">
                <div class="well">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <!-- <th>product ID</th> -->
                                <th>product Name</th>
                                <th>description</th>
                                <!-- <th>aution product status</th> -->
                                <th>variations</th>
                                <th>color</th>
                                <th>Brand</th>
                                <th>Material</th>
                                <th>stock</th>
                                <th>category</th>
                                <th>gender</th>
                                <th style="width: 36px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td><img src="../images/css.png" alt="" width="100" height="100"></td>
                                <td>CORE 1011</td>
                                <td>Tompson</td>
                                <td>AUCTION 1011</td>
                                //<td>YES/NO</td>
                                <td><span>10</span><br><span>11</span></td>
                                <td><span>Red</span><br><span>Blue</span></td>
                                <td>the_mark7</td>
                                <td>MARK</td>
                                <td>100</td>
                                <td>Tompson</td>
                                <td>Male/Female</td>                                
                                <td>
                                    <a href="user.html" title="Edit"><i class='fas fa-edit'></i></a>
                                    <a href="#myModal" role="button" data-toggle="modal" title="remove"><i class='fas fa-trash-alt'></i></a>
                                </td>
                            </tr> -->

                            <?php     
                                //for pagination
                                $page = @$_GET['page'];
                                                        
                                if($page == 0 || $page == 1){
                                    $page1 = 0;	
                                }
                                else {
                                    $page1 = ($page * 3) - 3;	//calculate more than 1 page's limit(start,3) 
                                }
                                //end code

                                if(isset($_SESSION['sellerId'])){
                                    $sellerId = $_SESSION['sellerId'];
                                    $productSQL = "select * from product where sellerId = '$sellerId' and auctionStatus = 'no'"." LIMIT ".$page1.", 3";
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

                                            if( strlen( $productName ) > 40 ) {
                                                $productName = substr( $productName, 0, 40 ) . '...';
                                            }

                                            if( strlen( $productDescription ) > 50 ) {
                                                $productDescription = substr( $productDescription, 0, 50 ) . '...';
                                            }

                            ?>
                                <tr>
                                    <td><input type="checkbox" name="item[]" style="margin-left:38%" value="<?php echo $productId;?>"></td>
                                    <td><img src="../images/productImage/<?php echo $productCoverImage; ?>" alt="" width="100" height="100"></td>
                                    <!-- <td><?php echo $productId; ?></td> -->
                                    <td><?php echo $productName; ?></td>
                                    <td><?php echo $productDescription; ?></td>
                                    <!-- <td><?php echo $productAuctionStatus; ?></td> -->
                                    <td><span>10</span><br><span>11</span></td>
                                    <td><span><?php echo $productColor; ?></span></td>
                                    <td><?php echo $productBrand; ?></td>
                                    <td><?php echo $productMaterial; ?></td>
                                    <td><?php echo $productSoldRecord; ?></td>
                                    <td><?php echo $productCategoryId; ?></td>
                                    <td><?php echo $productGender; ?></td>                                
                                    <td>
                                        <a href="./createProduct.php?productId=<?php echo $productId; ?>" title="Edit" style="color:blue"><i class='fas fa-edit'></i></a>
                                        <!-- <a href="#myModal" role="button" data-toggle="modal" title="remove" onclick="openModal()" value="<?php echo $productId;?>"><i class='fas fa-trash-alt'></i></a> -->
                                    </td>
                                </tr>
                            <?php
                                        } //end while
                                    }//end if
                                }else{
                                    echo'<script type=text/javascript>window.alert("Please Login First")</script> ';
                                    header("location:./login.php");
                                }//end session
                            
                            ?>
                            
                            <!-- <tr>
                                <td>#</td>
                                <td>CORE 1011</td>
                                <td>Tompson</td>
                                <td>AUCTION 1011</td>
                                <td>YES/NO</td>
                                <td><span>10</span><br><span>11</span></td>
                                <td><span>Red</span><br><span>Blue</span></td>
                                <td>the_mark7</td>
                                <td>MARK</td>
                                <td>100</td>
                                <td>Tompson</td>
                                <td>Male/Female</td>                                
                                <td>
                                    <a href="user.html" title="Edit"><i class='fas fa-edit'></i></a>
                                    <a href="#myModal" role="button" data-toggle="modal" title="remove"><i class='fas fa-trash-alt'></i></a>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pagination-box">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-lg">                
                            <?php                                            
                                $result = $conn->query("SELECT * FROM product where auctionStatus = 'no'");
                                $count = $result->num_rows;
                                            
                                $a = $count / 3;
                                $a = ceil($a);
                            ?>
                            <?php for ($i = 1; $i <= $a; $i++) {?>
                                <li class="page-item"><a class="page-link" href="viewProduct.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li> 
                            <?php } ?>
                        <button type="button" title="remove" class="delete-box-btn" onclick="openModal()"><i class='fas fa-trash-alt'>Delete</i></button>
                    </ul>
                    <!-- <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        <div class="delete-btn-container">
                        </div>
                    </ul>                     -->
                </nav>                 
            </div>

            

            <!-- <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Delete Confirmation</h3>
                </div>
                <div class="modal-body">
                    <p class="error-text">Are you sure you want to delete the user?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div> -->

            <!-- The Modal -->
            <div id="deleteModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close" data-dismiss="modal">&times;</span>
                    <p>Proudct Name: <span><?php echo $deleteMessage ?>	</span><br> Are you sure you want to delete this item?</p>
                    
                    <div class="modal-footer">
                        <!-- <div class="confirm-box"> -->
                            <button type="submit" name="delete">Confirm</button>
                            <button type="button" id="cancelDelete">Cancel</button>
                        <!-- </div> -->
                        <button type="button" id="closebtn" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                
            </div>
        </form>
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