<?php
include("../config.php");
include '../limitTimeSession.php';

date_default_timezone_set("Asia/Kuala_Lumpur");
$date =  date("Y-m-d h:i:s");// current year-month-days hours:minut:seconts

if(isset($_GET['productId'])){
    $productId = $_GET['productId'];
    $getProductData = "SELECT * FROM product WHERE id = '$productId' AND auctionStatus = 'no' AND status= ''";
    $resultgetProductData = $conn->query($getProductData);
    if($resultgetProductData->num_rows > 0){ //over 1 database(record) so run
        while($row = $resultgetProductData->fetch_assoc()){
            $ProductId = $row['id'];
            $ProductName = $row['name'];
            $ProductPrice = $row['price'];
            $ProductDescription = $row['description'];
            $ProductCoverImage = $row['coverImage'];
            $ProductColor = $row['color'];
            $ProductBrand = $row['brand'];
            $ProductMaterial = $row['material'];
            $ProductGender = $row['gender'];
            $ProductSoldRecord = $row['soldRecord'];
            $ProductSellerId = $row['sellerId'];
            $ProductInventoryId = $row['InventoryId'];
            // $ProductImagesId = $row['imagesId'];
            
            $getAllImage = "select * from images where productId = '$productId'";
            $resultgetAllImage = $conn->query($getAllImage);
            if($resultgetAllImage->num_rows > 0){ //over 1 database(record) so run
                while($row = $resultgetAllImage->fetch_assoc()){
                    $ProductImage1 = $row['image1'];
                    $ProductImage2 = $row['image2'];
                    $ProductImage3 = $row['image3'];
                    $ProductImage4 = $row['image4'];
                    $ProductImage5 = $row['image5'];

                }//End getAllImage while
            //End getAllImage if
            }else{
                $ProductImage1 = " ";
                $ProductImage2 = " ";
                $ProductImage3 = " ";
                $ProductImage4 = " ";
                $ProductImage5 = " ";
            }

            $getInventory = "select * from inventory where productId = '$productId'";
            $resultgetInventory = $conn->query($getInventory);
            if($resultgetInventory->num_rows > 0){ //over 1 database(record) so run
                while($row = $resultgetInventory->fetch_assoc()){
                    $ProductInventoryId = $row['inventoryId'];
                    $ProductStock = $row['stock'];
                }//End inventory while
            }//End inventory if


            //get Rating 
            $getTotalRating = "SELECT COUNT(ratingValue) AS 'TotalRating' FROM rating WHERE productId = '$productId'";
            $getRatingAverage = "SELECT CAST(AVG(ratingValue) AS DECIMAL(10,2)) AS 'ratingAvergae' FROM rating WHERE productId = '$productId' GROUP BY productId";
            $getRating5 = "SELECT COUNT(ratingValue) AS '5Start' FROM rating WHERE productId = '$productId' AND ratingValue = '5'";
            $getRating4 = "SELECT COUNT(ratingValue) AS '4Start' FROM rating WHERE productId = '$productId' AND ratingValue = '4'";
            $getRating3 = "SELECT COUNT(ratingValue) AS '3Start' FROM rating WHERE productId = '$productId' AND ratingValue = '3'";
            $getRating2 = "SELECT COUNT(ratingValue) AS '2Start' FROM rating WHERE productId = '$productId' AND ratingValue = '2'";
            $getRating1 = "SELECT COUNT(ratingValue) AS '1Start' FROM rating WHERE productId = '$productId' AND ratingValue = '1'";

            $resultGetTotalRating = $conn->query($getTotalRating);
            $resultGetRatingAverage = $conn->query($getRatingAverage);
            $resultGetRating5 = $conn->query($getRating5);
            $resultGetRating4 = $conn->query($getRating4);
            $resultGetRating3 = $conn->query($getRating3);
            $resultGetRating2 = $conn->query($getRating2);
            $resultGetRating1 = $conn->query($getRating1);

            //loop total
            if($resultGetTotalRating->num_rows > 0){ 
                while($row = $resultGetTotalRating->fetch_assoc()){
                    $Product_rating_all = $row['TotalRating'];
                }

                //All average star 
                if($resultGetRatingAverage->num_rows > 0){ 
                    while($row = $resultGetRatingAverage->fetch_assoc()){
                        $Product_rating_average = $row['ratingAvergae'];
                    }
                }else{
                    $Product_rating_average = 0;
                }
                
                //loop 5 star
                if($resultGetRating5->num_rows > 0){ 
                    while($row = $resultGetRating5->fetch_assoc()){
                        $Product_rating_fiveStar = $row['5Start'];
                        $rating_percentge_fiveStar = get_percentage($Product_rating_fiveStar,$Product_rating_all).'%';
                    }
                }else{
                    $Product_rating_fiveStar = 0;
                    $rating_percentge_fiveStar = "0%";
                }
    
                //loop 4 star
                if($resultGetRating4->num_rows > 0){ 
                    while($row = $resultGetRating4->fetch_assoc()){
                        $Product_rating_fourStar = $row['4Start'];
                        $rating_percentge_fourStar = get_percentage($Product_rating_fourStar ,$Product_rating_all).'%';
                    }
                }else{
                    $Product_rating_fourStart = 0;
                    $rating_percentge_fourStar = "0%";
                }

                //loop 3 star
                if($resultGetRating3->num_rows > 0){
                    while($row = $resultGetRating3->fetch_assoc()){
                        $Product_rating_threeStar = $row['3Start'];
                        $rating_percentge_threeStar = get_percentage($Product_rating_threeStar ,$Product_rating_all).'%';
                    }
                }else{
                    $Product_rating_threeStar = 0;
                    $rating_percentge_threeStar = "0%";
                }

                //loop 2 star
                if($resultGetRating2->num_rows > 0){
                    while($row = $resultGetRating2->fetch_assoc()){
                        $Product_rating_twoStar = $row['2Start'];
                        $rating_percentge_twoStar = get_percentage($Product_rating_twoStar,$Product_rating_all).'%';
                    }
                }else{
                    $Product_rating_twoStar = 0;
                    $rating_percentge_twoStar = "0%";
                }


                //loop 1 star
                if($resultGetRating1->num_rows > 0){
                    while($row = $resultGetRating1->fetch_assoc()){
                        $Product_rating_oneStar = $row['1Start'];
                        $rating_percentge_oneStar = get_percentage($Product_rating_oneStar,$Product_rating_all).'%';
                    }
                }else{
                    $Product_rating_oneStar = 0;
                    $rating_percentge_oneStar = "0%";
                }
            
            }else{
                $Product_rating_all = 0;
            }
            //End Calculate rating



        }//End getProductData while
    //End getProductData if
    }else{
        header("Location: ../user/404.html");
        die();
    }
}else{
    header("Location: ../user/404.html");
    die();
}


//find percentage for rating
function get_percentage($number, $total){
    if ( $total > 0 ) {
        return round($number / ($total / 100),2);
    }else {
        return 0;
    }
}
?>


<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="Productdetail.css"> -->
<!-- <script defer src="Productdetail.js"></script> -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet"> -->
	    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> -->
	    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> -->
	    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2. 3.4/assets/owl.theme.default.min.css"> -->
        <title>Product Detail</title>
        <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/homestyle.css">
        <link rel="stylesheet" href="../css/product.css">
        <style>
            /* The Modal (background) */
            .modal {
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
            .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            }

            /* The Close Button */
            .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position:relative;
            left:95%;
            }

            .close:hover,
            .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
            }

            .product-detail-variation {
                border: 2px solid #cd5c5c;
                margin:0px 10px;
                padding:1%;
                border-radius:5px;
                text-align:center;
                cursor:default;
            }
            .add-modal-variation-group {
                width:90%;
                margin:0% 2%;
            }
            @media screen and (max-width:800px){
                .modal-content{margin:30% 10%}
            }


            .heading {
            font-size: 25px;
            margin-right: 25px;
            }

            .fa {
            font-size: 25px;
            }

            .checked {
            color: orange;
            }

            /* Three column layout */
            .side {
            float: left;
            width: 15%;
            margin-top:10px;
            }

            .middle {
            margin-top:10px;
            float: left;
            width: 70%;
            }

            /* Place text to the right */
            .right {
            text-align: right;
            }

            /* Clear floats after the columns */
            .row:after {
            content: "";
            display: table;
            clear: both;
            }

            /* The bar container */
            .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
            }

            /* Individual bars */
            .bar-5 {width: <?php echo $rating_percentge_fiveStar;?>; height: 18px; background-color: #4CAF50;}
            .bar-4 {width: <?php echo $rating_percentge_fourStar;?>; height: 18px; background-color: #2196F3;}
            .bar-3 {width: <?php echo $rating_percentge_threeStar;?>; height: 18px; background-color: #00bcd4;}
            .bar-2 {width: <?php echo $rating_percentge_twoStar;?>; height: 18px; background-color: #ff9800;}
            .bar-1 {width: <?php echo $rating_percentge_oneStar;?>; height: 18px; background-color: #f44336;}

            /* Responsive layout - make the columns stack on top of each other instead of next to each other */
            @media (max-width: 400px) {
            .side, .middle {
                width: 100%;
            }
            .right {
                display: none;
            }
            }


            .post-container .post-detail{
              margin-left: 65px;
              position: relative;
            }

            .post-container .post-detail .post-text{
              line-height: 24px;
              margin: 0;
            }

            .post-container .post-detail .reaction{
              position: absolute;
              right: 0;
              top: 0;
            }

            .post-container .post-detail .post-comment{
              display: inline-flex;
              margin: 10px auto;
              width: 100%;
            }

            .post-container .post-detail .post-comment img.profile-photo-sm{
              margin-right: 10px;
            }

            .post-container .post-detail .post-comment .form-control{
              height: 36px;
              border: 1px solid #ccc;
              box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
              margin: 7px 0;
              min-width: 0;
            }

            img.profile-photo-md {
                height: 50px;
                width: 50px;
                border-radius: 50%;
            }

            img.profile-photo-sm {
                height: 40px;
                width: 40px;
                border-radius: 50%;
            }

            .text-green {
                color: #8dc63f;
            }

            .text-red {
                color: #ef4136;
            }

            .following {
                color: #8dc63f;
                font-size: 12px;
                margin-left: 20px;
            }

            .submitReplyPost {
                margin-top:10%;
            }
        </style>
    </head>

    <body>
        <?php require '../user/header.php' ?>        

        <div class="pd-wrap">
            <div class="product-detail-content">

                <!-- header text -->
                <div class="heading-section">
                    <h2>-- Product Details --</h2>
                </div>

                <!-- product detail info -->
                <div class="card">
                    <div class="row">

                        <!-- left info -->
                        <aside class="col-sm-5 border-right">
                            <article class="gallery-wrap"> 
                                <div class="img-big-wrap" id="changeImage">
                                    <div><img data-alt-src="/images/productImage/<?php echo $ProductImage1;?>" src="../images/productImage/<?php echo $ProductCoverImage;?>" style="width:100%" class="pro-img"></div>
                                </div> <!-- slider-product.// -->
                                <div class="img-small-wrap">
                                    <div class="item-gallery" id="changeImage" onclick="changeImage(this)"> <img data-alt-src="/images/productImage/<?php echo $ProductCoverImage;?>" src="../images/productImage/<?php echo $ProductCoverImage;?>"> </div>
                                    <?php
                                        if($ProductImage1 == " "){
                                            $selectImage = "SELECT * FROM productmedia WHERE productId = '$productId'";
                                            $resultSelectImage = $conn->query($selectImage);
                                            if($resultSelectImage->num_rows > 0){ //over 1 database(record) so run
                                                while($row = $resultSelectImage->fetch_assoc()){
                                                    $ProductFile = $row['filePath'];
                                                    $ProductFileType = $row['fileType'];
                                                    
                                                    if($ProductFileType == "image"){
                                    ?>
                                        <div class="item-gallery" id="changeImage" onclick="changeImage(this)"> <img data-alt-src="/images/productImage/<?php echo $ProductFile;?>" src="../images/productImage/<?php echo $ProductFile;?>"> </div>

                                    <?php
                                                    }else if($ProductFileType == "video"){
                                    ?>
                                        <div class="item-gallery" id="changeImage" onclick="changeImage(this)">
                                            <video src='../images/productImage/<?php echo $ProductFile;?>' controls width='100%' height='100%' >
                                        </div>
                                    <?php
                                                    }
                                                }
                                            }
                                        }else{
                                    ?>  
                                        <div class="item-gallery" id="changeImage" onclick="changeImage(this)"> <img data-alt-src="/images/productImage/<?php echo $ProductImage1;?>" src="../images/productImage/<?php echo $ProductImage1;?>"> </div>
                                        <div class="item-gallery" id="changeImage" onclick="changeImage(this)"> <img data-alt-src="/images/productImage/<?php echo $ProductImage2;?>" src="../images/productImage/<?php echo $ProductImage2;?>"> </div>
                                        <div class="item-gallery" id="changeImage" onclick="changeImage(this)"> <img data-alt-src="/images/productImage/<?php echo $ProductImage3;?>" src="../images/productImage/<?php echo $ProductImage3;?>"> </div>
                                        <div class="item-gallery" id="changeImage" onclick="changeImage(this)"> <img data-alt-src="/images/productImage/<?php echo $ProductImage4;?>" src="../images/productImage/<?php echo $ProductImage4;?>"> </div>
                                        <div class="item-gallery" id="changeImage" onclick="changeImage(this)"> <img data-alt-src="/images/productImage/<?php echo $ProductImage5;?>" src="../images/productImage/<?php echo $ProductImage5;?>"> </div>
                                    <?php
                                        }
                                    ?>
                                  
                                </div> <!-- slider-nav.// -->
                            </article> <!-- gallery-wrap .end// -->
                        </aside>

                        <!-- right info -->
                        <div class="col-md-6">
                            <div class="product-dtl">

                                <div class="product-info">
                                    <div class="product-name mt-3"><?php echo $ProductName;?></div>
                                    <div class="reviews-counter">
                                        <div class="rate mt-2">
                                            <span class="fa fa-star displaystarReview"></span>
                                            <span class="fa fa-star displaystarReview"></span>
                                            <span class="fa fa-star displaystarReview"></span>
                                            <span class="fa fa-star displaystarReview"></span>
                                            <span class="fa fa-star displaystarReview"></span>
                                        </div>
                                        <div class="row">
                                            <span class="text-danger font-weight-bold pl-4" style="font-size:30px"> <?php echo $Product_rating_average;?> </span> 
                                            <h5 class="pl-2 pt-3"> Ratings</h5>
                                            <span class="text-danger font-weight-bold pl-4" style="font-size:30px"> <?php echo $ProductSoldRecord;?> </span> 
                                            <h5 class="pl-2  pt-3"> Sold</h5>
                                        </div>
                                    </div>
                                    <div class="product-price-discount"><span>RM <?php echo $ProductPrice;?></span><span class="line-through">RM <?php echo $ProductPrice;?></span></div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <?php if(isset($_GET['productId'])){
                                            $productId = $_GET['productId'];
                                            $GetVariationSql = "select * from variation where productId = '$productId'";
                                            $resultVariation = $conn->query($GetVariationSql);

                                            if($resultVariation->num_rows > 0){ //over 1 database(record) so run
                                                while($row = $resultVariation->fetch_assoc()){
                                                    $VariationId = $row['variationId'];
                                                    $Variation = $row['variation'];
                                        ?>
                                            <div class="product-detail-variation">
                                                <input type="hidden" name="variationid" value="<?php echo $VariationId;?>">
                                                <div><?php echo $Variation;?></div>
                                            </div>

                                        <?php
                                                }
                                            }
                                        }?>
                                    </div>
                                </div>
                                <!-- <p>Disposable Mouth Masks, Professional 3-Layer Thicker Anti Dust Breathable Disposable Earloop Face Mask, Comfortable Sanitary Mask Feature: Color: blue Type: Civilian masks disposable Size:17.5x9.5cm/6.9*3.7 inches</p> -->
                                
                                <!-- <p><?php echo $ProductDescription;?></p> -->
                                <div class="product-count">
                                    <label for="size">Quantity</label>
                                    <form action="#" class="display-flex">
                                        <!-- <div class="qtyminus">-</div> -->
                                        <input type="button" class="qtyminus" value="-">
                                        <input type="text" name="quantity" id="quantityValue" value="1" class="qty">
                                        <input type="button" class="qtyplus" value="+">
                                        <input type="hidden" id="stock" value="<?php echo $ProductStock;?>">
                                        <div class="stock-text"> Available Stock: <?php echo $ProductStock;?></div>
                                        <p id="errorText" style="line-height:0px;padding:8px 15px;color:red;position:relative;top:8px;font-weight:bold"></p>
                                        <!-- <div class="qtyplus">+</div> -->
                                    </form>
                                    <button type="submit" id="myBtn" class="round-black-btn">Add to Cart</button>
                                    <!-- <a href="#" id="myBtn" class="round-black-btn">Add to Cart</a> -->
                                </div>

                            </div>
                        </div>

                    </div> <!--End row-->
                </div><!--End card-->


                <!-- detail list -->
                <div class="product-info-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="specifation-tab" data-toggle="tab" href="#specifation" role="tab" aria-controls="specifation" aria-selected="true">Specifation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                        </li>
                    </ul>

                    <!-- list content -->
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="specifation" role="tabpanel" aria-labelledby="specifation-tab">
                            <div class="col-lg-12 shadow p-3 rounded">
                                <div class="specifation-spacing">
                                    <label class="shipping-place">Shipping_place:</label>
                                    <div>Puchong, 47130 Selangor</div>
                                </div>
                                <div class="specifation-spacing">
                                        <label class="shipping-place">Brand: </label>
                                        <div><?php echo $ProductBrand;?></div>
                                </div>
                                <div class="specifation-spacing">
                                        <label class="shipping-place">Material: </label>
                                        <div><?php echo $ProductMaterial;?></div>
                                </div>
                            </div>

                        </div>
                            
                        <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="col-lg-12 shadow p-5 rounded">
                                <?php echo $ProductDescription;?>
                            </div>
                        
                        </div>
                                
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                           <div class="col-lg-12">
                                <div class="shadow-sm p-3 mb-3 bg-light rounded">
                                        <div class="row col-5">
                                            <span class="heading">
                                                <?php echo $Product_rating_average;?> 
                                                <span class="text-muted">average based on </span>
                                                <?php echo $Product_rating_all;?>
                                                <span class="text-muted"> reviews.</span>
                                            </span>

                                            <input type="hidden" name="ratingValue" id="displayRatingValue" value="<?php echo $Product_rating_average;?>">
                                            <input type="hidden" name="productId" id="productId" value="<?php echo $productId;?>">
                                            <input type="hidden" name="newcomment" id="newComment" value = "">
                                            <span class="fa fa-star displaystar"></span>
                                            <span class="fa fa-star displaystar"></span>
                                            <span class="fa fa-star displaystar"></span>
                                            <span class="fa fa-star displaystar"></span>
                                            <span class="fa fa-star displaystar"></span>
                                        </div>

                                        <!-- <hr style="border:3px solid #f1f1f1"> -->
                                        
                                        <!-- rating bar -->
                                        <div class="row col-5">
                                            <div class="side">
                                                <div>5 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                <div class="bar-5"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div><?php echo $Product_rating_fiveStar;?></div>
                                            </div>
                                            <div class="side">
                                                <div>4 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                <div class="bar-4"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div><?php echo $Product_rating_fourStar;?></div>
                                            </div>
                                            <div class="side">
                                                <div>3 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                <div class="bar-3"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div><?php echo $Product_rating_threeStar;?></div>
                                            </div>
                                            <div class="side">
                                                <div>2 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                <div class="bar-2"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div><?php echo $Product_rating_twoStar;?></div>
                                            </div>
                                            <div class="side">
                                                <div>1 star</div>
                                            </div>
                                            <div class="middle">
                                                <div class="bar-container">
                                                <div class="bar-1"></div>
                                                </div>
                                            </div>
                                            <div class="side right">
                                                <div><?php echo $Product_rating_oneStar;?></div>
                                            </div>
                                        </div>
                                </div>


                                <div class="" id="ShowAllReview">
                                        <div class="post-container shadow-sm p-3 mb-3 bg-light rounded">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="profile-photo-md pull-left">
                                            <div class="post-detail">
                                                <div class="user-info">
                                                    <h5>
                                                        <a href="timeline.html" class="profile-link">Alexis Clark</a> 
                                                        <span class="following">
                                                            <span class="fa fa-star displaystar"></span>
                                                            <span class="fa fa-star displaystar"></span>
                                                            <span class="fa fa-star displaystar"></span>
                                                            <span class="fa fa-star displaystar"></span>
                                                            <span class="fa fa-star displaystar"></span>
                                                        </span>
                                                    </h5>
                                                    <p class="text-muted">Published a photo about 3 mins ago</p>
                                                </div>
                                                <div class="reaction">
                                                    <a class="btn text-green"><i class="fa fa-thumbs-up"></i> 13</a>
                                                    <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                                                </div>
                                                <div class="line-divider"></div>
                                                <div class="post-text">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                                </div>
                                                <div class="post-comment">
                                                    <div class="row ml-2">
                                                        <div class="mr-2" style="width:15%">
                                                            <img src='../images/feedback-images/A001.jpg' class="w-100">
                                                        </div>
                                                        <div class="mr-2" style="width:15%">
                                                            <img src='../images/feedback-images/A001.jpg' class="w-100">
                                                        </div>
                                                        <div class="mr-2" style="width:15%">
                                                            <video src='../images/feedback-images/Dream it possible.mp4' controls width='100%' height='100%' >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="line-divider"></div>
                                                <div class="post-comment">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" class="profile-photo-sm">
                                                    <p><a href="timeline.html" class="profile-link">Diana </a><i class="em em-laughing"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                                                </div>
                                                <div class="post-comment">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="profile-photo-sm">
                                                    <p><a href="timeline.html" class="profile-link">John</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                                                </div>
                                                <div class="post-comment input-group mb-3">
                                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="profile-photo-sm">
                                                    <input type="text" class="form-control" placeholder="Post a comment" aria-label="post a comment" aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-secondary mt-2 h-75" type="button" id="button-addon2">Button</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                           </div>
                            <!--End responesive box col-lg-12-->


                        </div><!--End tab-pane-->

                    </div><!--End tab content-->

                </div> <!--product-info-tabs-->

            </div><!--End container-->
        </div><!--End pd-wrap-->

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <form action="../database/user/cart.php" method="post">
                <input type="hidden" name="productId" value="<?php echo $productId;?>">
                <input type="hidden" name="sellerId" value="<?php echo $ProductSellerId;?>">
                <div class="col-md-12">
                    <h3>Product Variation - select variation</h3>
                    <div class="row">
                        <div class="form-group add-modal-variation-group">
                            <select class="form-control" name="SelectVariation">
                                <?php 
                                    if(isset($_GET['productId'])){
                                        $productId = $_GET['productId'];
                                        $getVariation = "select * from variation where productId = '$productId'";
                                        $resultgetVariation = $conn->query($getVariation);
                                        if($resultgetVariation->num_rows > 0){ //over 1 database(record) so run
                                            while($row = $resultgetVariation->fetch_assoc()){
                                                $ProductVariationId = $row['variationId'];
                                                $ProductAllVariation= $row['variation'];
                                ?>
                                <option  value="<?php echo $ProductAllVariation;?>"><?php echo $ProductAllVariation;?></option>
                                <?php                               
                                            }//End variation while                                
                                        }//End variation if
                                    } 
                                ?>
                            </select>
                        </div>
                    
                        <!-- <input type="checkbox" name="variationId[]" value="<?php echo $ProductVariationId;?>">
                        <input type="button" name="variation[]" class="" value="<?php echo $ProductAllVariation;?>">
                     -->
                    </div>
                    <div class="product-count">
                        <label for="size">Quantity</label>
                        <div class="display-flex">
                            <!-- <div class="qtyminus">-</div> -->
                            <input type="button" class="qtyminus" value="-">
                            <input type="text" name="quantity" id="quantityValueModal" value="1" class="qty">
                            <input type="button" class="qtyplus" value="+">
                        </div>
                        <div class="row">
                            <div class="stock-text"> Available Stock: <?php echo $ProductStock;?></div>
                                <p id="errorText1" style="line-height:0px;padding:8px 15px;color:red;position:relative;top:8px"></p>
                        </div>
                            
                        <button type="submit" name="AddToCart" class="round-black-btn">Add to Cart</button>
                        <!-- <a href="#" id="myBtn" class="round-black-btn">Add to Cart</a> -->
                    </div>
                    <!-- <div class="row">
                        <input type="button" class="qtyminus" value="-">
                        <input type="text" name="quantity" id="quantityValue" value="1" class="qty">
                        <input type="button" class="qtyplus" value="+">
                        <div class="stock-text"> Available Stock:</div>
                    </div> -->
                    <!-- <button type="submit" name="AddToCart">Add to cart</button> -->
                </div>
                  
                </form>   
            </div>
        </div> <!--End modal-->



        <?php 
            if(isset($_SESSION['m'])){ ?>
            <div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>
        <?php } ?>
        

        <?php require '../user/footer.php'?>
        </body>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="	sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> <!-- for product detail -- tab bar-->
        <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> <!-- for product detail -- tab bar-->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script><!--Ajax -- Review-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script><!--JS Sweet Alert-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script><!-- Sweet Alert JS  -->
        <script src="../js/userProductDetail.js"></script>
        <script src="../js/homescript.js"></script>
        <script>
            // var sourceSwap = function () {
            //     var $this = $(this);
            //     var newSource = $this.data('alt-src');
            //     $this.data('alt-src', $this.attr('src'));
            //     $this.attr('src', newSource);
            // }
            // $(function() {
            //     $('img[data-alt-src]').each(function() { 
            //         new Image().src = $(this).data('alt-src'); 
            //     }).hover(sourceSwap, sourceSwap); 
            // });

            var flashdata = $('.flash-data').data('flashdata')
                if(flashdata == "Insert-New-Post-Success-01"){
                    Swal.fire(
                        'Success!',
                        'Your are comment the post!',
                        'success'
                    )
                }else if(flashdata == "Insert-New-Post-Failed-Value-Lost-01"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please Type Some Text To Comment!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }else if(flashdata == "insert-comment-image-media-type-invalid-notic-01"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Insert Comment Media Failed',
                        text: 'Please Try Again!'
                    })
                }else if(flashdata == "Add-To-Cart-failed-1Notif"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops... Add To Cart Failed',
                        text: 'Please Try Again!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }

                


            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }


            // Detail -- change Image
            function changeImage(event) {
                document.querySelector(" .pro-img").src = event.children[0].src;
                // console.log(event.children[0].src); get img src link
            }

            function openBrowser(){
                $("#inputCommentFile").click();
                
            }

            function checkFile(file){
                if ($("#inputCommentFile")[0].files.length <= 3) {
                    return true;
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Number Of File Error',
                        text: 'Please Select Maximun 3 File!'
                    })
                    return false;
                    $('#inputCommentFile').click();
                }
            }

            $(document).ready(function() {
                var a = $('#displayRatingValue').val();
                for(var i=0; i<=a-1; i++){
                    $(".displaystar").eq(i).addClass(" checked");
                    $(".displaystarReview").eq(i).addClass(" checked");
                }
            });

            $(document).ready(function() {
                var productID = $('#productId').val();
                var action = "display";
                $.ajax({
                    url:"../database/user/productReview.php",
                    method:"POST",
                    data:{
                        productId:productID,
                        methodAction:action
                    }, //this is what data send between hyperlink
                    success:function(data)
                    {
                        $('#ShowAllReview').html(data); //show in this dynaimic_content place
                    }
                }); 
            });

            function postNewReply(element) {
                var ratingid = $(element).data('rating');
                var userid = $(element).data('user');

                if(userid == " "){
                    
                    swal({title:'login notification', 
                        text:'Please login first', 
                        icon:'warning', 
                        buttons: true
                    })
                    .then((willOUT) => {
                            if (willOUT) {
                                  window.location.href = 'login.php', {
                                  icon: 'success',
                                }
                              }
                    });

                // }else{
                //     var action = "insertPost";
                //     var inputValue = $('#newComment').val();
                //     console.log(ratingid);
                //     console.log(userid);
                //     console.log(inputValue);
                //     element.preventDefault();
                //     $.ajax({
                //     url:"../database/user/insertNewComment.php",
                //     method:"POST",
                //     data:{
                //         ratingId:ratingid,
                //         insertMethodAction:action,
                //         userID:userid,
                //         insertComment:inputValue
                //     }, //this is what data send between hyperlink
                //     success:function(data)
                //     {
                //        //show in this dynaimic_content place
                //     }
                //     }); 

                }
            }

            // function keyupGetInput(comment){
            //     let commentInput =  $(comment).val();
            //     // console.log(commentInput);
            //     // return commentInput;
            //     document.getElementById("newComment").value = commentInput;
            // }

        $(document).ready(function(){
            $('#searchProductBtn').click(function(){
                var keyword = $('#inputKeyword').val();
                window.location.href = "../user/searchProduct.php?query="+keyword;
            });

        });

        </script>
    </html>