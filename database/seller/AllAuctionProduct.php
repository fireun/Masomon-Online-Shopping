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
$DueDateSql = " ";
// $BidSql1=" ";
// $BidSql2=" ";

//search name
if(isset($_POST['filterName'])){
    $name = $_POST['filterName'];
    if($name != NULL){
        $NameSql = " AND product.name LIKE '%$name%' ";
    }
}

//search price
if( isset($_POST['filterMinPrice']) && isset($_POST['filterMaxPrice']) ){
    $minPrice = $_POST['filterMinPrice'];
    $maxPrice = $_POST['filterMaxPrice'];
    $PriceSql = " AND product.price BETWEEN '$minPrice' AND '$maxPrice'";
}

//search stock
// if(isset($_POST['filterBid'])){
//     $bid = $_POST['filterBid'];
//     if($bid != NULL){
//         $BidSql1 = " LEFT JOIN auctionrecord ON product.id = auctionrecord.productId ";
//         $BidSql2 = " ORDER BY Bid $bid";
//     }
// }

//search sold record
if(isset ($_POST['filterDueDate'])){
    $DueDate = $_POST['filterDueDate'];
    $Date_Format = date('Y-m-d',strtotime($DueDate));
    if($DueDate != NULL){
        $DueDateSql = " AND product.date='$Date_Format'";
    }      
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

$displayAuctionProductTable = "SELECT * FROM product WHERE product.sellerId = '$sellerId' AND product.status = '' AND product.auctionStatus = 'yes' ".$NameSql.$PriceSql.$DueDateSql.$rowDataSql."";
$resultDisplayAuctionProductTable =  mysqli_query($conn,$displayAuctionProductTable) or die('<tr class="text-center"><td colspan="6"> No Found Result </td></tr>');

if(mysqli_num_rows($resultDisplayAuctionProductTable)>0){
    while($row = mysqli_fetch_array($resultDisplayAuctionProductTable)){
      $productName = $row['name'];
    //   $productName = !empty($_POST['filterName'])?hightlightWords($row['name'],$_POST['filterName']):$row['name'];

      $auctionDueDate = $row["auctionDueDate"];
      $auction_Date_Format = date('d-m-Y h:i:s a',strtotime($auctionDueDate));
      if( strlen( $productName ) > 60 ) {
          $productName = substr( $productName, 0, 60 ) . '...';
      }
    
    if(!empty($_POST["filterName"])) {
        $productName = highlightKeywords($row["name"],$_POST["filterName"]);
    }

    if(!empty($_POST["filterDueDate"])) {
        $auction_Date_Format = highlightKeywords($row["auctionDueDate"],$_POST["filterDueDate"]);
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
            <td style="width:30%">
                '.$auction_Date_Format.'
            </td>
            <td style="width:15%">
                <a href="../business/createAuctionProduct.php?edit-auction-product-id='.$row["id"].'" type="button" class="btn-primary rounded pl-2 pr-2 pt-1 pb-1" data-toggle="tooltip" data-placement="top" title="View Detail" >
                    <i class="fas fa-eye"></i>
                </a>
                <button class="btn-info rounded checkRecord text-light" data-toggle="tooltip" data-placement="top" title="Check Auction Record" value = "'.$row["id"].'" onclick="checkAuctionRecord(this)">
                <i class="fas fa-list-ol"></i>
                </button>
            </td>
        </tr>
        ';
    }// end while
}else{
  $output .= '
        <tr class="text-center">
            <td colspan="6" >
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