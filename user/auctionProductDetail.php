<?php
include("../config.php");
include '../limitTimeSession.php';

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d h:i:s");// current year-month-days hours:minut:seconts


if(isset($_GET['auctionId'])){
    $productId = $_GET['auctionId'];
    $getProductData = "SELECT * FROM product WHERE id = '$productId' AND auctionStatus='yes'";
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
            $ProductInventoryId = $row['InventoryId'];
            // $ProductImagesId = $row['imagesId'];
            $aAuctionDueDate = $row['auctionDueDate'];

            $turnDate = strtotime($aAuctionDueDate);
            $FormationDueDate = date(" Y-m-d h:i:s a",$turnDate);

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
        }//End getProductData while

        $getAuctionRecord = "select * from auctionRecord where productId = '$productId' Order by bid DESC LIMIT 1";
        $resultgetAuctionRecord = $conn->query($getAuctionRecord);
        if($resultgetAuctionRecord->num_rows > 0){ //over 1 database(record) so run
            while($row = $resultgetAuctionRecord->fetch_assoc()){
                $auctionRecordId = $row['auctionRecordId'];
                $auctionBid = $row['bid'];
                $auctionDate = $row['date'];

            }//End record while
        }else {
            $auctionBid = $ProductPrice;
        }

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

        .count-box{
            background: #CD5C5C;
            height: 15%;
            margin: 0% 0% 3% 0%;
            padding: 0.5% 10%;
        }
        .countDown-box {
            width: 20%;
            /* border: 5px solid white; */
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-align:center;
        }
        .countdown-text{
            font-size:30px;
            font-weight:bold;
            font-family: fantasy;
        }
        @media screen and (max-width:800px){
            .modal-content{margin:30% 10%}
            .count-box {height:25%;}
            .countDown-box{margin: 1% 2%;}
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
                    <input type="hidden" id="forReviewProductId" value="<?php echo $productId;?>">
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
                                    <div class="product-name"><?php echo $ProductName;?></div>
                                    <div class="reviews-counter">
                                        <div class="reviews-counter">
                                            <div class="rate mt-2">
                                            <?php
                                                for($x=0; $x<$Product_rating_average; $x++){
                                                ?>
                                                        <span class="fa fa-star displaystar checked"></span>
                                                <?php
                                                    }
                                            ?>
                                            </div>
                                            <!-- <span>3 Reviews</span> -->
                                        </div>
                                    </div>
                                    <div class="product-price-discount"><span><strong>Current High Bid: RM<?php echo $auctionBid;?></strong></span><span class="line-through">RM <?php echo $ProductPrice;?></span></div>
                                    <div class="product-price-discount"><span><strong>Due Date: <?php echo $FormationDueDate;?></strong></div>
                                        
                                    <?php //over due date hidden
                                        if($aAuctionDueDate >= $date){
                                    ?>
                                        <div class="row count-box">
                                            <input type="hidden" id="duedatecal" value="<?php echo $aAuctionDueDate?>">
                                            <div class="countDown-box"><span class="countdown-text" id="countdown"></span> <br> Days</div>
                                            <div class="countDown-box"><span class="countdown-text" id="countdown1"></span> <br> Hours</div>
                                            <div class="countDown-box"><span class="countdown-text" id="countdown2"></span> <br> Minutes</div>
                                            <div class="countDown-box"><span class="countdown-text" id="countdown3"></span> <br> Seconds</div>
                                        </div>
                                    <?php
                                        }else{
                                            
                                        }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Ranking</th>
                                                <th>User Name</th>
                                                <th>Bid</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $countRecord1 = 0;
                                            $getRecordLeader = "select user.userName,auctionrecord.* from auctionRecord LEFT JOIN user on auctionrecord.userId = user.userId where productId = '$productId' Group by bid DESC LIMIT 0,3";
                                            $resultgetRecordLeadere = $conn->query($getRecordLeader);
                                            if($resultgetRecordLeadere->num_rows > 0){ //over 1 database(record) so run
                                                while($row = $resultgetRecordLeadere->fetch_assoc()){
                                                    $auctionRecordId = $row['auctionRecordId'];
                                                    $userName = $row['userName'];
                                                    $userId = $row['userId'];
                                                    $auctionRecordBid = $row['bid'];
                                                    $auctionDate = $row['date'];
                                                    $modifed_date_Format = date('d/m/Y h:i:s a',strtotime($auctionDate));
                                                    $countRecord1++;          
                                        ?>
                                        <tr>
                                            <input type="hidden" value="<?php echo $auctionRecordId ?>">
                                            <td><?php echo $countRecord1;?></td>
                                            <td><?php echo $userName?></td>
                                            <td>RM <?php echo $auctionRecordBid?></td>
                                            <td><?php echo $modifed_date_Format;?></td>
                                        </tr>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    No Participant Yet
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>

                                <?php //over due date hidden join btn
                                    if($aAuctionDueDate >= $date){
                                ?>
                                    <div class="product-count">
                                        <button type="button" id="myBtn" class="round-black-btn">Join </button>
                                        <!-- <a href="#" id="myBtn" class="round-black-btn">Add to Cart</a> -->
                                    </div>
                                <?php
                                    }else{
                                        
                                    }
                                ?>
                                

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
                            <a class="nav-link" id="auctionRecord-tab" data-toggle="tab" href="#auctionRecord" role="tab" aria-controls="auctionRecord" aria-selected="false">Auction Record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
                        </li>
                    </ul>

                    <!-- list content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- spcification -->
                        <div class="tab-pane fade show active" id="specifation" role="tabpanel" aria-labelledby="specifation-tab">
                            <div class="col align-self-center shadow-sm p-3 bg-white rounded">
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
                        <!--End spcification -->
                            
                        <!-- Description -->
                        <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="col align-self-center shadow-sm p-3 bg-white rounded">
                                <?php echo $ProductDescription;?>
                            </div>
                        </div>
                        <!-- End Description -->

                        <!-- Auction Record -->
                        <div class="tab-pane fade" id="auctionRecord" role="tabpanel" aria-labelledby="auctionRecord-tab">
                            <div class="table-responsive col align-self-center shadow-sm p-3 bg-white rounded">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Bid</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Bid</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $countRecord = 0;
                                            $getRecordLeader = "select user.userName,auctionrecord.* from auctionRecord LEFT JOIN user on auctionrecord.userId = user.userId where productId = '$productId' Group by bid DESC";
                                            $resultgetRecordLeadere = $conn->query($getRecordLeader);
                                            if($resultgetRecordLeadere->num_rows > 0){ //over 1 database(record) so run
                                                while($row = $resultgetRecordLeadere->fetch_assoc()){
                                                    $auctionRecordId = $row['auctionRecordId'];
                                                    $userName = $row['userName'];
                                                    $userId = $row['userId'];
                                                    $auctionRecordBid = $row['bid'];
                                                    $auctionDate = $row['date'];
                                                    $modifed_date_Format = date('d/m/Y h:i:s a',strtotime($auctionDate));
                                                    $countRecord++;
                                                    
                                        ?>
                                        <tr>
                                            <input type="hidden" value="<?php echo $auctionRecordId ?>">
                                            <td><?php echo $countRecord;?></td>
                                            <td><?php echo $userName?></td>
                                            <td>RM <?php echo $auctionRecordBid?></td>
                                            <td><?php echo $modifed_date_Format;?></td>
                                        </tr>
                                        <?php
                                                }
                                            }else{
                                        ?>
                                            <td colspan="4" class="text-center">
                                                No Participant Yet
                                            </td>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--End Auction Record -->

                        <!-- Review -->
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        
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
                                    <?php
                                         for($x=0; $x<$Product_rating_average; $x++){
                                     ?>
                                             <span class="fa fa-star displaystar checked"></span>
                                     <?php
                                         }
                                     ?>
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
                                
                            </div>
                        <!-- End Review -->

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
                <form action="../database/user/cartProcess.php" method="post" id="formBid" onsubmit="return checkBid()">
                <input type="hidden" name="productId" value="<?php echo $productId;?>">
                <div class="col-md-12">
                    <div class="product-count">
                        <label for="size"><strong>Enter Bid</strong></label>
                        <hr>
                        <div class="row">
                            <div class="stock-text">Current High Bid: <span id="currentBid"><?php echo $auctionBid;?></span></div>
                        </div>
                        <div class="display-flex">
                            <input type="text" name="bid" id="valueBid" placeholder = "RM" min="<?php echo $auctionBid;?>" max="9999" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpast="return false">
                            <p id="errorText1" style="line-height:0px;padding:8px 15px;color:red;position:relative;top:8px"></p>
                        </div>
                        <div class="row">
                            <h5 class="text-secondary pl-3 mt-3">Due Date: <?php echo $FormationDueDate; ?></h5>
                            <input type="hidden" name="duedate" value="<?php echo $FormationDueDate; ?>">
                        </div>
                        <button type="submit" name="InsertBid" class="round-black-btn">Join Auction</button>
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
                        text: 'Plesa Type Some Text To Comment!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                }else if(flashdata == "insert-comment-image-media-type-invalid-notic-01"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Insert Comment Media Failed',
                        text: 'Please Try Again!'
                    })
                }

            //swap image
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
            
            // Detail -- change Image
            function changeImage(event) {
                document.querySelector(" .pro-img").src = event.children[0].src;
                // console.log(event.children[0].src); get img src link
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

            function checkBid() {
                var currentBid = document.getElementById("currentBid").textContent;
                // console.log(currentBid);
                var checkInputBid = document.querySelector('[name="bid"]').value;
                // console.log(checkInputBid);
                if(checkInputBid <= currentBid) {
                    document.getElementById('errorText1').innerHTML = " *Input Bid must be high current bid  ";
                    return false;
                }else{
                    document.getElementById('errorText1').innerHTML = "";
                    return true;
                }
            }


            var x = setInterval(function() {
            var time = document.getElementById('duedatecal').value;
            var countDownDate = new Date(time).getTime();

            // Get today's date and time
            var now = new Date().getTime();
                
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
                
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            // Output the result in an element with id="demo" days hours miniustes seconds
            document.getElementById("countdown").innerHTML = days ;
            document.getElementById("countdown1").innerHTML = hours ;
            document.getElementById("countdown2").innerHTML = minutes;
            document.getElementById("countdown3").innerHTML = seconds ;

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                document.getElementById("auction").innerHTML = "EXPIRED";
            }
            }, 1000);

            // Detail -- change Image
            function changeImage(event) {
                document.querySelector(" .pro-img").src = event.children[0].src;
                // console.log(event.children[0].src); get img src link
            }

            $(document).ready(function() {
                var a = $('#displayRatingValue').val();
                for(var i=0; i<=a-1; i++){
                    $(".displaystar").eq(i).addClass(" checked");
                    $(".displaystarReview").eq(i).addClass(" checked");
                }
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

            var flashdata = $('.flash-data').data('flashdata');
            if(flashdata == "update-bid-success-notic-01"){
                Swal.fire(
                    'Update Success!',
                    'This Status has been successfully updated!',
                    'success'
                )
            }else if(flashdata == "update-bid-failed-notic-01"){
                Swal.fire({
                    icon: 'error',
                    title: 'Updated Status Failed',
                    text: 'Please Try Again!'
                })
            }else if(flashdata == "insert-bid-success-notic-01"){
                Swal.fire(
                    'Insert Bid Success!',
                    'This Status has been successfully insert!',
                    'success'
                )
            }else if(flashdata == "insert-bid-failed-notic-01"){
                Swal.fire({
                    icon: 'error',
                    title: 'Insert Bid Status Failed',
                    text: 'Please Try Again!'
                })
            }else if(flashdata == "insert-bid-overTime-failed-notic-01"){
                Swal.fire({
                    icon: 'error',
                    title: 'This Auction Product is Over time',
                    text: 'Sorry, you are miss the due date '
                })
            }

            
        </script>
        <script>
             $(document).ready(function() {
                var productID = $('#forReviewProductId').val();
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

            $(document).ready(function(){
                $('#searchProductBtn').click(function(){
                    var keyword = $('#inputKeyword').val();
                    window.location.href = "../user/searchProduct.php?query="+keyword;
                });
            });
        </script>
    </html>