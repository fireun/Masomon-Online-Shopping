<?php
include("../config.php");
session_start();

$category = "";
if(isset($_GET['categoryid'])){
    $categoryId = $_GET['categoryid'];
    $categorySql = "select categoryType from category where categoryId = '$categoryId'";
    $resultCategorySql = $conn->query($categorySql);
    if($resultCategorySql->num_rows > 0){ //over 1 database(record) so run
        while($row = $resultCategorySql->fetch_assoc()){
            $category = $row['categoryType'];
            $bothName = $row['categoryType'];
        }
    }
}else{
    $categoryId = "search";
}

if(isset($_GET['query'])){
    $searchKeyword = $_GET['query'];
    $bothName = $_GET['query'];
}else{
    $searchKeyword = "noSearch";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title>

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
    <style>
        section{
          padding: 0!important;
        }
       section.range-slider {
            position: relative;
            width: 160px;
            height: 35px;
            text-align: center;
        }

        section.range-slider input {
            pointer-events: none;
            position: absolute;
            overflow: hidden;
            left: 15px;
            top: 15px;
            width: 175px;
            outline: none;
            height: 18px;
            margin: 0;
            padding: 0;
        }

        section.range-slider input::-webkit-slider-thumb {
            pointer-events: all;
            position: relative;
            z-index: 1;
            outline: 0;
        }

        section.range-slider input::-moz-range-thumb {
            pointer-events: all;
            position: relative;
            z-index: 10;
            -moz-appearance: none;
            width: 9px;
        }

        input[type="range"]{
          background:blue;
        }

        .brand{
            cursor:pointer;
        }
    </style>
<script>
var key = '<?php echo $searchKeyword?>';

if("<?php echo $categoryId;?>" ==  "search"){
    var cate = "noCategory";
}else{
    var cate = <?php echo $categoryId?>;
}
// console.log(key);
// console.log(cate);

$(document).ready(function(){
    filter_data(1, key, cate);
    
    function filter_data(page, keyword, category,  topSale, minPrice, maxPrice)
    {
        // $('.filter_data').html('<div id="loading" style="" ></div>');
        // var action = 'fetch_data';
        // var minimum_price = $('#hidden_minimum_price').val();
        // var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        // var ram = get_filter('ram');
        // var storage = get_filter('storage');
        $.ajax({
            url:"../database/user/search.php",
            method:"POST",
            data:{page:page, keyword:keyword, brand:brand, category:category, topSale:topSale, minP:minPrice, maxP:maxPrice},
            success:function(data){
                $('#dynamic_content').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        var minPrice = $('#searchMinPrice').val();
        var maxPrice = $('#searchMaxPrice').val();

        filter_data(1,key,cate, '', minPrice, maxPrice);
    });


    $('#inputKeyword').change(function(){
      var keyword = $('#inputKeyword').val();
      window.location.href = "../user/searchProduct.php?query="+keyword;
    });

    $('#searchProductBtn').click(function(){
        var keyword = $('#inputKeyword').val();
        window.location.href = "../user/searchProduct.php?query="+keyword;
    });

    $('#topsale').click(function(){
        var topS = "topSale";
        filter_data(1,key,cate,topS);
    });

    $('#relevance').click(function(){
        var topS = "relevance";
        filter_data(1,key,cate,topS);
        $('.brand').each(function() {
			this.checked = false;
		});
    });

    $('#filterPrice').change(function(){
        var choice = $('#filterPrice').val();
        filter_data(1,key,cate,choice);
    });

    $('#filterPriceRange').click(function(){
        var minPrice = $('#searchMinPrice').val();
        var maxPrice = $('#searchMaxPrice').val();

        filter_data(1,key,cate, '', minPrice, maxPrice);
    });
    
});
</script>
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
                            <?php 
                                if(isset($_GET['query'])){
                                    $searchKeywordBrand = $_GET['query'];
                                    $searchBrand = 'SELECT DISTINCT brand FROM product WHERE name LIKE "%'.str_replace(' ', '%', $searchKeywordBrand).'%"';
                                    $resultBrand = $conn->query($searchBrand);
                                    if($resultBrand ->num_rows>0){
                                        while($row = $resultBrand ->fetch_assoc()){
                                
                            ?>
                                <li class="list-group-item" style="border:0px;padding-top:0px">
                                    <input type="checkbox" class="common_selector brand" value="<?php echo $row['brand'];?>"> <?php echo $row['brand'];?>
                                </li>
                            <?php
                                        }
                                    }
                                }

                                if(isset($_GET['categoryid'])){
                                    $categoryBrand = "SELECT DISTINCT brand FROM product LEFT JOIN category ON category.categoryId = product.categoryId WHERE product.categoryId = '$categoryId'";
                                    $resultCategoryBrand = $conn->query($categoryBrand);
                                    if($resultCategoryBrand ->num_rows>0){
                                        while($row = $resultCategoryBrand ->fetch_assoc()){
                                
                            ?>
                                <li class="list-group-item" style="border:0px;padding-top:0px">
                                    <input type="checkbox" class="common_selector brand" value="<?php echo $row['brand'];?>"> <?php echo $row['brand'];?>
                                </li>
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
                                    <section class="range-slider">
                                    <span class="rangeValues font-weight-bold pl-5"></span>
                                    <input value="0" min="0" max="9998.5" step="0.5" type="range">
                                    <input value="9999" min="0.5" max="9999" step="0.5" type="range">
                                    <input type="hidden" id="searchMinPrice">
                                    <input type="hidden" id="searchMaxPrice">
                                  </section>
                                <button type="button" name="FilterPriceRange" id="filterPriceRange" class="btn btn-danger filter-price-btn">Filter</button>         
                            </div>
                        </div>
                    </div>
                    <!--End fiter price range--->
            </div><!--End left box-->



            <!-- right box side -->
            <div class="col-md-10">

                <div class="col-md-12">
                    <div class="row">
                        <h3 id="SearchText">Search <span class="text-danger font-weight-bold" style="font-size: larger;">" <?php echo $bothName;?> "</span> Result </h3>
                    </div>
                </div>

                <div class="container">

                    <div class="col-md-12 pb-2">
                        <div class="row pb-2 pt-2" style="background:rgba(0,0,0,.03">
                            <h5 class="pt-2 pr-3 pl-2 font-weight-bold sort-text">Sort By</h5>                            
                            <div class="btn-group">
                                <button type="button" name="relevance" id="relevance" class="btn btn-danger sort-bar active">Relevance</button>
                                <button type="button" name="topsale" id="topsale" class="btn btn-danger sort-bar">Top Sale</button>
                                <select name="filterPrice" id="filterPrice" class="custom-select custom-select-height sort-bar">
                                    <option value="ASC" >Price: Low to High</option>
                                    <option value="DESC">Price: High to Low</option>
                                </select>
                                <!-- <button type="button" class="btn btn-danger sort-bar" id="SortBarSearchBtn" onclick="openSearchBox()">Open Filter</button> -->
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dynamic_content">
                    </div>

                </div><!--End right container--> 
            </div><!--End right size box-->  
               

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
                        <input class="form-control" name="SmallPrice"  type="text">
                    </div>
                    <div class="mobile-col-price-width">
                        ——
                    </div>
                    <div class="mobile-col-price-width">
                        <!-- <label for="ex1">col-xs-2</label> -->
                        <input class="form-control"  name="HighPrice" type="text">
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-danger mobile-filter-btn" name="FilterPriceRange">Filter</button>
                </div>
        </div>
        </form>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script src="../js/homescript.js"></script>
<!-- <script src="../js/searchAjax.js"></script> -->
<script type="text/javascript">
function openSearchBox() {
  document.getElementById("SearchBar").style.width = "90%";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function  closeSearchBox() {
  document.getElementById("SearchBar").style.width = "0";
  document.body.style.backgroundColor = "white";
}

    //slider range price
    function getVals(){
      // Get slider values
      var parent = this.parentNode;
      var slides = parent.getElementsByTagName("input");
        var slide1 = parseFloat( slides[0].value );
        var slide2 = parseFloat( slides[1].value );
      // Neither slider will clip the other, so make sure we determine which is larger
      if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }
      
      var displayElement = parent.getElementsByClassName("rangeValues")[0];
          displayElement.innerHTML = slide1 + " - " + slide2;
          $("#searchMinPrice").val(slide1); // sets first handle (index 0) to 50
          $("#searchMaxPrice").val(slide2); // sets second handle (index 1) to 80
    }

    window.onload = function(){
      // Initialize Sliders
      var sliderSections = document.getElementsByClassName("range-slider");
          for( var x = 0; x < sliderSections.length; x++ ){
            var sliders = sliderSections[x].getElementsByTagName("input");
            for( var y = 0; y < sliders.length; y++ ){
              if( sliders[y].type ==="range" ){
                sliders[y].oninput = getVals;
                // Manually trigger event first time to display values
                sliders[y].oninput();
              }
            }
          }
    }
</script>
</html>