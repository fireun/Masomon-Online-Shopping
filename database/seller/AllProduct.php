<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d h:i:s");// current year-month-days hours:minut:seconts

$sellerId = $_SESSION['sellerId'];
$Page = 0;
$output = "";
$NameSql = " ";
$PriceSql = " ";
$StockSql = " ";


//search name
if(isset($_POST['filterName'])){
    $name = $_POST['filterName'];
    if($name != NULL){
        $NameSql = " AND product.name LIKE '%$name%'";
    }else{
        $NameSql = " ";
    }
}

//search price
if( isset($_POST['filterMinPrice']) && isset($_POST['filterMaxPrice']) ){
    $minPrice = $_POST['filterMinPrice'];
    $maxPrice = $_POST['filterMaxPrice'];
     $PriceSql = " AND product.price BETWEEN '$minPrice' AND '$maxPrice'";

}

//search stock
if(isset($_POST['filterStock'])){
    $stock = $_POST['filterStock'];
    if($stock != NULL){
        $StockSql = " AND inventory.totalStock LIKE '%$stock%'";
    }else{
        $StockSql = " ";
    }
}

//search sold record
if(isset ($_POST['filterSoldRecord'])){
    $soldRecord = $_POST['filterSoldRecord'];
    $SoldRecordSql = " ORDER BY product.soldRecord $soldRecord";
}else{
    $SoldRecordSql = " ORDER BY product.soldRecord ASC";
}

//search row
if(isset($_POST['filterRowData']) ){
    $rowData = $_POST['filterRowData'];
    if($rowData == "all"){
        $rowDataSql = " ";
    }else{
        $rowDataSql = " LIMIT $Page, $rowData";
    }
}else{
    $rowDataSql = " LIMIT $Page, 5";
}

$displayProductTable = "SELECT * FROM product LEFT JOIN inventory ON product.id = inventory.productId WHERE product.sellerId = '$sellerId' AND product.status = '' AND product.auctionStatus = 'no' ".$NameSql.$PriceSql.$StockSql.$SoldRecordSql.$rowDataSql."";
$resultDisplayProductTable =  mysqli_query($conn,$displayProductTable) or die('<tr class="text-center"><td colspan="6"> No Found Result </td></tr>');

if(mysqli_num_rows($resultDisplayProductTable)>0){
    while($row = mysqli_fetch_array($resultDisplayProductTable)){
      $productName = $row['name'];
      $productStock = $row["totalStock"];

      if( strlen( $productName ) > 60 ) {
          $productName = substr( $productName, 0, 60 ) . '...';
      }

    //   $productName = !empty($_POST['filterName'])?hightlightWords($productName,$_POST['filterName']):$productName;

    if(!empty($_POST["filterName"])) {
        $productName = highlightKeywords($row["name"],$_POST["filterName"]);
    }

    if(!empty($_POST["filterStock"])) {
        $productStock = highlightKeywords($row["totalStock"],$_POST["filterStock"]);
    }
      $output .= '
        <tr>
            <td> 
                <img src="../images/productImage/'.$row["coverImage"].'" width="55" height="55">
            </td>
            <td>
                '.$productName.'
            </td>
            <td>
                '.$row["price"].'
            </td>
            <td>
                '.$productStock.'
            </td>
            <td>
                '.$row["soldRecord"].'
            </td>
            <td style="width:15%">
                <a href="../business/createProduct.php?edit-product-id='.$row["id"].'" type="button" class="btn-primary rounded pl-2 pr-2 pt-1 pb-1" data-toggle="tooltip" data-placement="top" title="View Detail" >
                    <i class="fas fa-eye"></i>
                </a>
                <a href="../database/seller/productAction.php?removeId='.$row["id"].'" class="btn-danger rounded pl-2 pr-2 pt-1 pb-1" data-toggle="tooltip" data-placement="top" title="Remove Product" >
                    <i class="far fa-trash-alt"></i>
                </a>
            </td>
        </tr>
        ';
    }// end while
}else{
  $output .= '
    <tr>
        <td colspan="6" class="text-center">
            No Found Result
        </td>
    </tr>
  ';
}

echo $output;

//hight light search text
function hightlightWords($text, $word){
    $text = preg_replace('#'.preg_quote($word).'#i','<span style="background-color:yellow" class="rounded p-1">\\0</span>',$text);
    return $text;
}

//hight light search text 2
function highlightKeywords($text, $keyword) {
    $wordsAry = explode(" ", $keyword);
    $wordsCount = count($wordsAry);
    
    for($i=0;$i<$wordsCount;$i++) {
        $highlighted_text = "<span style='font-weight:bold;background:yellow'  class='rounded p-1'>$wordsAry[$i]</span>";
        $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
    }

    return $text;
}