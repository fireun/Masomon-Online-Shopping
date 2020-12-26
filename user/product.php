<?php
include("../config.php");
session_start();

$category = "";
if(isset($_GET['categoryid'])){
    $categoryId = $_GET['categoryid'];
    $_SESSION['categoryId'] = $categoryId;
    $categorySql = "select categoryType from category where categoryId = '$categoryId'";
    $resultCategorySql = $conn->query($categorySql);
    if($resultCategorySql->num_rows > 0){ //over 1 database(record) so run
        while($row = $resultCategorySql->fetch_assoc()){
            $categoryType = $row['categoryType'];
        }
    }
}

$category="";
if(isset($_GET['categoryid'])){
    $_SESSION['categoryId'] = $_GET['categoryid'];
    $category=" and categoryId='".$_GET['categoryid']."'";
}
        
//for pagination
      $page = @$_GET['page']; 
      if($page == 0 || $page == 1){
        $page1 = 0;	
      }
      else {
        $page1 = ($page * 9) - 9;	
      }
//end code

//get search keyword
$search="";
if(isset($_POST['search'])){
    $searchKeyword = $_POST['keyword'];
    $_SESSION['search'] = $searchKeyword;
    $search=" and name like '%".$searchKeyword."%'";
    
}


// if(isset($_GET['categoryid'])){ 
//     $categoryId = $_GET['categoryid'];
//     $getCategoriesData = "select * from product where categoryId = '$categoryId' and auctionStatus = 'no'";
//     $resultgetCategoriesData = $conn->query($getCategoriesData);
//     if($resultgetCategoriesData->num_rows > 0){ //over 1 database(record) so run
//         while($row = $resultgetCategoriesData->fetch_assoc()){
//             $cProductId = $row['id'];
//             $cProductName = $row['name'];
//             $cProductPrice = $row['price'];
//             $cProductDescription = $row['description'];
//             $cProductCoverImage = $row['coverImage'];
//             $cProductColor = $row['color'];
//             $cProductBrand = $row['brand'];
//             $cProductMaterial = $row['material'];
//             $cProductGender = $row['gender'];
//             $cProductSoldRecord = $row['soldRecord'];
//             $cProductInventoryId = $row['InventoryId'];
//             $cProductImagesId = $row['imagesId'];
//         }
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>

    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2. 3.4/assets/owl.theme.default.min.css"><div class="pd-wrap"> -->
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/homestyle.css">
    <link rel="stylesheet" href="../css/userproduct.css">

    <!-- header and footer link -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css"> -->

    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <?php require '../user/header.php' ?>
    
    <div class="product-page-container col-md-12 pt-10">
        <div class="row">

        <!-- left box side -->
        <div class="col-md-2" id="searchBar">
            <h4 class="font-weight-bold"><i class="fa fa-filter" style="font-size:20px;padding:0px 3px 0px 0px;"></i>Search Filter</h4>
            <!-- brand select -->
            <div class="left-box">
                <h4><strong>Brand</strong></h4>
                <ul class="list-group brand-ul">

    <form action="product.php" method="post" id="SideFilter">
                <?php
                    if(isset($_SESSION['search'])){
                        $searchKeyword = $_SESSION['search'];
                        $brandSql = "select brand from product where name like '%".$searchKeyword."%' GROUP BY brand DESC";
                        $resultBrand = $conn->query($brandSql);
                        if ($resultBrand->num_rows > 0) {
                            while($row = $resultBrand->fetch_assoc()) {   
                                $brandName = $row['brand'];    
                    
                ?>
                    <li class="list-group-item " style="border:0px;padding-top:0px"><input type="checkbox" name="Brand[]" value="<?php echo $brandName;?>" onclick="($('#SideFilter')).submit();"><?php echo $brandName;?></li>
                    <!-- <li class="list-group-item " style="border:0px;padding-top:0px"><input type="checkbox" name="" id=""> Oppo</li> -->
                    <!-- <li class="list-group-item " style="border:0px;padding-top:0px"><input type="checkbox" name="" id=""> Samsung</li> -->
                <?php
                            }
                        }
                    }
                ?>
                </ul>
            </div>
        
             <!-- filter price range -->
            <div class="left-box"> 
                <h4><strong>Price Range</strong></h4>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-3 col-price-width">
                            <!-- <label for="ex1">col-xs-2</label> -->
                            <input class="form-control" name="SmallPrice" id="ex1" type="text">
                        </div>
                        <div class="col-xs-3 col-price-width">
                            ——
                        </div>
                        <div class="col-xs-3 col-price-width">
                            <!-- <label for="ex1">col-xs-2</label> -->
                            <input class="form-control" name="HighPrice" id="ex1" type="text">
                        </div>
                        <button type="submit" name="FilterPriceRange" class="btn btn-danger filter-price-btn">Filter</button>
                        
                    </div>
                </div>
            </div><!--End fiter price range--->
        </form>

        </div> <!--End left box-->

        <!-- right box side -->
        <div class="col-md-10">
            <!-- <div class="container-fluid"> -->
                <div class="col-md-12">
                    <div class="row">
                        <?php if(isset($_GET['categoryid'])){ ?>
                            
                            <h3 id="SearchText">Search result for ' <span class="font-weight-bold" style="color:#CD5C5C;font-size:25px"><?php echo $categoryType;?></span> '</h3>
                        <?php
                         }else if(isset($_SESSION['search'])){
                                                       
                         ?>
                            <h3 id="SearchText">Search result for ' <span class="font-weight-bold" style="color:#CD5C5C;font-size:25px"><?php echo $_SESSION['search']; ?></span> '</h3>
                        <?php
                         }
                        ?>
  
                        
                        <!-- <div class="btn-group">
                            <button type="button" class="btn btn-danger active">Relevance</button>
                            <button type="button" class="btn btn-danger">Top Sale</button>
                            <select name="price" class="custom-select custom-select-height">
                                <option selected>Random Price</option>
                                <option value="low to high">Price: Low to High</option>
                                <option value="high to low">Price: High to Low</option>
                            </select>
                        </div> -->
                        <!-- <div class="row">

                        </div> -->
                    </div><!--End filter header row-->
                </div><!--End col header 12-->


                <!-- <div class="row"> -->
                <div class="container">
                    <!-- <h3 class="h3">shopping Demo-3 </h3> -->
                    <form action="product.php" method="post" id="submitForm">
                        <div class="col-md-12 pb-2">
                            <div class="row pb-2 pt-2" style="background:rgba(0,0,0,.03">
                                <h5 class="pt-2 pr-3 pl-2 font-weight-bold sort-text">Sort By</h5>                            
                                <div class="btn-group">
                                    <button type="submit" name="relevance" class="btn btn-danger sort-bar active">Relevance</button>
                                    <button type="submit" name="topsale" class="btn btn-danger sort-bar">Top Sale</button>
                                    <select name="filterPrice" class="custom-select custom-select-height sort-bar" onchange="($('#submitForm')).submit();">
                                        <option value="" selected> <?php if(isset($_SESSION['FPrice'])){ echo $_SESSION['FPrice']; }else{ ?> -- Select One -- <?php } ?></option>
                                        <option value="ASC" >Price: Low to High</option>
                                        <option value="DESC">Price: High to Low</option>
                                    </select>
                                    <button type="button" class="btn btn-danger sort-bar" id="SortBarSearchBtn" onclick="openSearchBox()">Open Filter</button>
                                </div>
                            </div><!--End filter header row-->
                        </div>
                    </form>
                    

                    <div class="row">
                    <?php
                    
                    $relevanceSql = "";
                    if(isset($_POST['relevance'])){                                        
                        if(isset($_SESSION['search'])){
                            $searchKeyword = $_SESSION['search'];
                            $relevanceSql = " ";
                        }else if(isset($_GET['categoryid'])){
                            $categoryPass = $_SESSION['categoryId'];
                            $relevanceSql = " ";
                        } 
                    }

                    $topSql = "";
                    $PriceSql = "";
                    //top sale / price / Price Range
                    if(isset($_POST['topsale'])){   
                        if(isset($_SESSION['search'])){
                            $searchKeyword = $_SESSION['search'];
                            $topSql = " and name like '%".$searchKeyword."%' ORDER BY soldRecord DESC";
                        }else if(isset($_GET['categoryid'])){
                            $categoryPass = $_SESSION['categoryId'];
                            $topSql = "  and categoryId='$categoryPass' ORDER BY soldRecord DESC";
                        } 

                    }else if(isset($_POST['filterPrice'])){
                        $Pricevalue = $_POST['filterPrice'];

                        if($Pricevalue == "ASC"){
                            $_SESSION['FPrice'] = " High to Lower  ";
                        }else {
                            $_SESSION['FPrice'] = " Lower to High ";
                        }

                        if(isset($_SESSION['search'])){
                            $searchKeyword = $_SESSION['search'];
                            $PriceSql = " and name like '%".$searchKeyword."%' ORDER BY price $Pricevalue";
                        }else if(isset($_GET['categoryid'])){
                            $categoryPass = $_SESSION['categoryId'];
                            $PriceSql = " and categoryId='$categoryPass' ORDER BY price $Pricevalue";
                        }

                    }else {
                        unset($_SESSION['FPrice']);
                        $PriceSql = "";
                    }

                    $Brandsql = "";
                    if(!empty($_POST['Brand'])){
                        foreach($_POST['Brand'] as $Brand){
                            if(isset($_SESSION['search'])){
                                $searchKeyword = $_SESSION['search'];
                                $Brandsql = " and name like '%".$searchKeyword."%' and brand = '$Brand'";
                            }else if(isset($_GET['categoryid'])){
                                $categoryPass = $_SESSION['categoryId'];
                                $Brandsql = " and categoryId='$categoryPass' and brand = '$Brand'";
                            } 
                        } 
                    }

                    $PriceRange = "";
                    if(isset($_POST['FilterPriceRange'])){
                        $SmallPrice = $_POST['SmallPrice'];
                        $HighPrice = $_POST['HighPrice'];
                        
                        if(isset($_SESSION['search'])){
                            $searchKeyword = $_SESSION['search'];
                            if($SmallPrice != "" && $HighPrice != ""){
                                $PriceRange = " and name like '%".$searchKeyword."%' and price between $SmallPrice and $HighPrice";
                            }
                        }else if(isset($_GET['categoryid'])){
                            $categoryPass = $_SESSION['categoryId'];
                            if($SmallPrice != "" && $HighPrice != ""){
                                $PriceRange = " and categoryId='$categoryPass' and price between $SmallPrice and $HighPrice";
                            }  
                        }  
                    }

                                    $a = "";
                                    if(isset($_POST['search'])){
                                        $a = $search;
                                    }else if(isset($_GET['categoryid'])){
                                        $a = $category;
                                    }
                                    
                                    $sql="select * from product where auctionStatus='no' ".$a.$relevanceSql.$topSql.$PriceSql.$Brandsql.$PriceRange." LIMIT ".$page1.", 9";
                                    $result=$conn->query($sql);
                                    $_SESSION['CountResult'] = $result->num_rows ;
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {            
                                            $cProductId = $row['id'];
                                            $cProductName = $row['name'];
                                            $cProductPrice = $row['price'];
                                            $cProductDescription = $row['description'];
                                            $cProductCoverImage = $row['coverImage'];
                                            $cProductColor = $row['color'];
                                            $cProductBrand = $row['brand'];
                                            $cProductMaterial = $row['material'];
                                            $cProductGender = $row['gender'];
                                            $cProductSoldRecord = $row['soldRecord'];
                                            $cProductInventoryId = $row['InventoryId'];
                                            $cProductImagesId = $row['imagesId'];
                                ?>


                            <!--product -->
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid3">
                                    <div class="product-image3">
                                        <a href="../user/productDetail.php?productId=<?php echo $cProductId;?>">
                                            <img class="pic-1" src="../images/productImage/<?php echo $cProductCoverImage;?>">
                                            <img class="pic-2" src="../images/productImage/<?php echo $cProductCoverImage;?>">
                                        </a>
                                        <ul class="social">
                                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                            <li><a href="../user/productDetail.php?productId=<?php echo $cProductId;?>"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                        <span class="product-new-label">New</span>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="#"><?php echo $cProductName; ?></a></h3>
                                        <div class="price">
                                            RM <?php echo $cProductPrice;?>
                                            <span>RM <?php echo $cProductPrice; ?></span>
                                        </div>
                                        <ul class="rating mt-3">
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star disable"></li>
                                            <li class="fa fa-star disable"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!--End category product-->
                        <?php  }
                            }else{
                        ?>
                            <div class="row" style="padding:10% 40%">
                                <h2>No Result</h2>
                            </div>
                        <?php                                
                            }
                        ?>
                       
                        <!-- //first product
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid3">
                                <div class="product-image3">
                                    <a href="#">
                                        <img class="pic-1" src="http://bestjquery.com/tutorial/product-grid/demo4/images/img-1.jpg">
                                        <img class="pic-2" src="http://bestjquery.com/tutorial/product-grid/demo4/images/img-2.jpg">
                                    </a>
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                    <span class="product-new-label">New</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">Men's Blazer</a></h3>
                                    <div class="price">
                                        $63.50
                                        <span>$75.00</span>
                                    </div>
                                    <ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star disable"></li>
                                        <li class="fa fa-star disable"></li>
                                    </ul>
                                </div>
                            </div>
                        </div> //End first product -->

                    </div><!--End row-->

                    <div class="row">
                    <ul class="pagination pagination-md">
                          <?php                                  
                            // $result = $conn->query("SELECT * FROM product where auctionStatus='no'");
                            $count =  $_SESSION['CountResult'];                      
                            $a = $count / 9;
                            $a = ceil($a);
                          ?>
                            <?php for ($i = 1; $i <= $a; $i++) {?>
                              <li class="page-item"><a class="page-link" href="products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li> 
                            <?php } ?>
                    </ul>        
                    </div>
                </div><!--End product cart container-->

                
        </div> <!--End right size box-->
    </div><!--End row-->
    </div><!--End product page container-->

    <?php require '../user/footer.php' ?>

    <!-- scroll back to top
   <button onclick="topFunction()" class="back-top-btn" id="backToTop" title="Go to top">Top</button> -->

    <!-- mobile -->
    <div id="SearchBar" class="sidenav mobile-search-box">
        <a href="javascript:void(0)" class="closebtn" onclick="closeSearchBox()">&times;</a>
        <!-- <a href="#">About</a> -->
        <h2 class="pt-4 text-center mobile-header-text">Search Filter</h2>
        
        <form action="product.php" method="post" id="mobileFilter">
        <div class="col-md-12 mobile-brand-content-box">
            <h3>Brand</h3>
            <div class="row mobile-content-margin">
                <?php
                    if(isset($_SESSION['search'])){
                        $brandSql = "select brand from product where name like '%".$_SESSION['search']."%' GROUP BY brand DESC";
                        $resultBrand = $conn->query($brandSql);
                        if ($resultBrand->num_rows > 0) {
                            while($row = $resultBrand->fetch_assoc()) {   
                                $brandName = $row['brand'];    
                    
                ?>
                <button type="submit" class="btn btn-info mobile-brand-btn" onclick="($('#mobileFilter')).submit();" name="Brand[]" value="<?php echo $brandName;?>"><?php echo $brandName;?></button>
                <!-- <button type="button" class="btn btn-info mobile-brand-btn">Item2</button>
                <button type="button" class="btn btn-info mobile-brand-btn">Item3</button>
                <button type="button" class="btn btn-info mobile-brand-btn">Item4</button> -->
                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>

        <div class="col-md-12 mobile-price-range-content-box">
            <h3>Price Range</h3>
            <div class="form-group">
                <div class="row" style="margin-left:0%">
                    <div class="mobile-col-price-width">
                        <!-- <label for="ex1">col-xs-2</label> -->
                        <input class="form-control" name="SmallPrice" id="ex1" type="text">
                    </div>
                    <div class="mobile-col-price-width">
                        ——
                    </div>
                    <div class="mobile-col-price-width">
                        <!-- <label for="ex1">col-xs-2</label> -->
                        <input class="form-control"  name="HighPrice" id="ex1" type="text">
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-danger mobile-filter-btn" name="FilterPriceRange">Filter</button>
                </div>
        </div>
        </form>
    </div>
</body>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script src="../js/homescript.js"></script>
<script>
function openSearchBox() {
  document.getElementById("SearchBar").style.width = "90%";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function  closeSearchBox() {
  document.getElementById("SearchBar").style.width = "0";
  document.body.style.backgroundColor = "white";
}



</script>
</html>