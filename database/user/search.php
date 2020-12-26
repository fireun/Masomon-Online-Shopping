<?php

$connect = new PDO("mysql:host=localhost; dbname=masomononlineshopping", "root", "");

/*function get_total_row($connect)
{
  $query = "
  SELECT * FROM tbl_webslesson_post
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  return $statement->rowCount();
}

$total_record = get_total_row($connect);*/

$limit = '12'; //show 5 result for each page
$page = 1;

//checking current page
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

$query = "
SELECT * FROM product
";

if($_POST['category'] != "noCategory"){
  $query .= '  LEFT JOIN category ON product.categoryId = category.categoryId ';

}
if($_POST['keyword'] != "noSearch" )
{
    $query .= '
    WHERE product.auctionStatus = "no" AND product.status = " " AND (product.name LIKE "%'.str_replace(' ', '%', $_POST['keyword']).'%" OR product.brand LIKE "%'.str_replace(' ', '%', $_POST['keyword']).'%") 
    ';
}

if($_POST['category'] != "noCategory"){
    $query .= " WHERE product.auctionStatus = 'no' AND product.status = ' ' AND product.categoryId = '". $_POST['category'] ."'";
}

if(isset($_POST["brand"]))
{
    if(isset($_POST['topSale']) != ''){
        $sale = $_POST['topSale'];
        if($sale == "relevance"){
            $query .= " ";
        }else{
            $brand_filter = implode('","', $_POST["brand"]);
            $query .= ' AND product.brand IN("'.$brand_filter.'") ';
        }
    }else{
        $brand_filter = implode('","', $_POST["brand"]);
        $query .= ' AND product.brand IN("'.$brand_filter.'") ';
    }
}

if( (isset($_POST['minP']) != '') && (isset($_POST['maxP']) != '') ){
    $minPrice = $_POST['minP'];
    $maxPrice = $_POST['maxP'];

    $query .= " AND (product.price >= '".$minPrice."' AND product.price <= '".$maxPrice."') ";
}

if(isset($_POST['topSale']) != ''){
    $sale = $_POST['topSale'];
    if($sale == "topSale"){
        $query .= ' ORDER BY product.soldRecord DESC ';

    }else if($sale == "relevance"){
        $query .= 'ORDER BY product.id ASC ';

    }else if($sale == "ASC"){
        $query .= 'ORDER BY product.price ASC ';

    }else if($sale == "DESC"){
        $query .= 'ORDER BY product.price DESC ';
    }

}else{
    $query .= 'ORDER BY id ASC ';
}

$filter_query = $query . 'LIMIT '.$start.', '.$limit.'';
//$query = Select * from product where auctionStatus = no and name like %searchkeyword% or brand like %searchkeyword% Order By id ASC LIMIT  currentNo,5;

$statement = $connect->prepare($query);
$statement->execute();//run sql
$total_data = $statement->rowCount();//caulculate how many row reult

$statement = $connect->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$total_filter_data = $statement->rowCount();


// design write in output    
$output = '';
//if have data in the row
if($total_data > 0)
{
  foreach($result as $row)
  {
    $output .= '
    
        <div class="col-md-3 col-sm-6">
                <div class="product-grid3">
                    <div class="product-image3">
                        <a href="../user/productDetail.php?productId='.$row["id"].'">
                            <img class="pic-1" src="../images/productImage/'.$row["coverImage"].'">
                            <img class="pic-2" src="../images/productImage/'.$row["coverImage"].'">
                        </a>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="../user/productDetail.php?productId='.$row["id"].'"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <span class="product-new-label">New</span>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">'.$row["name"].'</a></h3>
                        <div class="price">
                            RM '.$row["price"].'
                            <span>RM '.$row["price"].'</span>
                        </div>
                    </div>
                </div>
            
        </div>
    ';
  }
}
// no data in row
else
{
  $output .= '
    <div class="row" style="padding:10% 40%">
        <h2>No Result</h2>
    </div>
  ';
}

echo $output;

?>