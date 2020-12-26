<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");// current year-month-days hours:minut:seconts
$timestamp = date('00:00:00'); //midnight time 00:00:00
$nowTime = date('h:i:s'); //current time hours:minut:serconts


// $limit = '2'; //show 5 result for each page
// $page = 1;

// //checking current page
// if($_POST['page'] > 1)
// {
//   $start = (($_POST['page'] - 1) * $limit);
//   $page = $_POST['page'];
// }
// else
// {
//   $start = 0;
// }

if($_POST['chooseDate'] != "ALL"){
  $searchKeyword = $_POST['chooseDate'];
  $DateSql = "and date = '".$searchKeyword."'";
}else{
  $DateSql = " ";
}
//   $output .= '<label class="text-success">' . $message . '</label>';  
// $select_query = "SELECT * FROM product where auctionStatus = 'yes' ". $DateSql ."  ORDER BY auctionDueDate ASC  LIMIT ". $start .", $limit ";  
// SELECT * FROM product where auctionEnd = '' AND auctionStatus = 'yes' and date = '2020-11-16' ORDER BY auctionDueDate ASC;


// check time if current time is 00:00:00
if($nowTime >= $timestamp){

  //get if over due date and unfind winner
  $checkDueDate = "SELECT * FROM product where auctionStatus = 'yes' AND auctionEnd = '' AND auctionDueDate < '$date' ORDER BY auctionDueDate ASC";  
  $result = mysqli_query($conn,$checkDueDate);


  // $get_Still_live = "SELECT product.*, auctionrecord.* FROM product LEFT JOIN auctionrecord ON product.id = auctionrecord.productId WHERE product.auctionStatus = 'yes' AND auctionEnd = ''";
  // $result_Check_live = mysqli_query($conn,$get_Still_live);
  if($result ->num_rows>0){
    while($row = $result ->fetch_assoc()){
        $product_id = $row['id'];
        $seller_id = $row['sellerId'];
        $product_auctionDueDate = $row['auctionDueDate'];
        $format_auctionDueDate_12h = date('Y-m-d h:i:s', strtotime($product_auctionDueDate));

        // $format_auctionDueDate_12h = "2020-11-16 21:30:00";
        // $date = "2020-11-16 21:30:00";

          // check this auctionProduct high one bid winner
          $select_dueDate = "SELECT * FROM product LEFT JOIN auctionrecord on product.id = auctionrecord.productId WHERE product.auctionStatus = 'yes' AND product.auctionDueDate = '$product_auctionDueDate' AND productId = '$product_id' ORDER BY auctionrecord.bid DESC LIMIT 1";
          $resultGetDueDate = $conn->query($select_dueDate);

          if($resultGetDueDate ->num_rows>0){
            while($row = $resultGetDueDate ->fetch_assoc()){
              $winner_product_id = $row['id'];//product id
              $winner_id = $row['auctionRecordId'];//auctionRecordId
              $winner_user = $row['userId'];
              
              $update_winner = "UPDATE product SET auctionEnd = '$winner_id' where id = '$winner_product_id'";
              $resultUpdater = $conn->query($update_winner);

              //insert to user cart
              $detentionPeriod =  date('Y-m-d h:i:s', strtotime($date. ' + 2 days') );
              $generateCartId = uniqid();

              $insertCart = "INSERT INTO cartintegration (cartIntegrationId, cartId, productId, userId, sellerId, variation, quantity, status, detentionPeriod, created_time, update_time)
                VALUES ('$generateCartId', '', '$winner_product_id', '$winner_user ', '$seller_id', '','1','','$detentionPeriod','$date','$date');";
              $resultInsertCart= $conn->query($insertCart);

              }
            }else{
              $update_no_winner = "UPDATE product SET auctionEnd = 'no winner' where id = '$product_id'";
              $result_update_nw = $conn->query($update_no_winner);
            }

          // //if check no winner
          // }else{
          //   $updateNoWinner = "";
    }
  }
  
}


//get high bid 
// SELECT * FROM `auctionrecord` WHERE productId = '5f4ce967cfd18' ORDER BY bid DESC LIMIT 1
$getAuctionProduct = "SELECT * FROM product where auctionStatus = 'yes' AND auctionEnd = '' ". $DateSql ." AND  auctionDueDate >= '$date' ORDER BY auctionDueDate ASC";
$resultGetAuction =  mysqli_query($conn,$getAuctionProduct);

$output = " ";
$total_data = 0;
//if have data in the row
if(mysqli_num_rows($resultGetAuction)>0){
    while($row = mysqli_fetch_array($resultGetAuction)){
      $output .= '
          <!-- //first product -->
          <div class="col-md-3 col-sm-6 mb-2  "> 
              <div class="product-grid3 shadow bg-white p-3 h-100" >
                  <div class="product-image3 h-70">
                      <a href="../user/auctionProductDetail.php?auctionId='.$row["id"].'">
                          <img class="pic-1" src="../images/ProductImage/'.$row["coverImage"].'">
                          <img class="pic-2" src="../images/ProductImage/'.$row["coverImage"].'">
                      </a>
                      <ul class="social">
                          <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                          <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                      </ul>
                      <span class="product-new-label">New</span>
                  </div>
                  <div class="product-content">
                      <h3 class="title"><a href="#">'.$row["name"].'</a></h3>
                      <div class="price">
                          '.$row["price"].'
                          <span>'.$row["price"].'</span>
                      </div>
                      <ul class="rating">
                          <li class="fa fa-star"></li>
                          <li class="fa fa-star"></li>
                          <li class="fa fa-star"></li>
                          <li class="fa fa-star disable"></li>
                          <li class="fa fa-star disable"></li>
                      </ul>
                    <div class="price" style="color:grey">
                          Due Date: '.$row["auctionDueDate"].'
                    </div>
                  </div>
              </div>
          </div> <!--//End first product-->
      ';
      $total_data++;
    }
}else{
  $output .= '
  <div class="col font-weight-bold mt-4" align="center"><h2>-- No Data Found --</h2></div>
  ';
}

// $output .= '

// <br />
// <div align="center" class="col mt-2">
//   <ul class="pagination">
// ';

// $total_links = ceil($total_data/$limit);//All rows/ 5
// $previous_link = '';
// $next_link = '';
// $page_link = '';

// //echo $total_links;
// $count_array = 0;
// if($total_links > 4){

//     //current page below than 5 page
//     if($page < 5){
//         for($count = 1; $count <= 5; $count++){
//           $page_array[] = $count; //page_array is store row page
//           $count_array = $count;
//         }
//         $page_array[] = '...';
//         $page_array[] = $total_links;
//         $count_array = $total_links;
    
//     //current page above than 5
//     }else{
//         $end_limit = $total_links - 5;
//         if($page > $end_limit){
//           $page_array[] = 1;
//           $count_array = 1;
//           $page_array[] = '...';
//           for($count = $end_limit; $count <= $total_links; $count++){
//             $page_array[] = $count;
//             $count_array = $count;
//           }
//         }else{
//           $page_array[] = 1;
//           $count_array = 1;
//           $page_array[] = '...';
//           for($count = $page - 1; $count <= $page + 1; $count++){
//             $page_array[] = $count;
//             $count_array = $count;
//           }
//           $page_array[] = '...';
//           $page_array[] = $total_links;
//           $count_array = $total_links;
//         }
//     }
// }else{
//     for($count = 1; $count <= $total_links; $count++){
//       $page_array[] = $count;
//       $count_array = $count;
//     }
// }

// for($count = 0; $count < $count_array; $count++){

//     //check current page
//     if($page == $page_array[$count]){
//         $page_link .= '
//         <li class="page-item active">
//           <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
//         </li>
//         ';

//         //prevoius function
//         $previous_id = $page_array[$count] - 1;
//         if($previous_id > 0){
//             $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
//         }else{
//             $previous_link = '
//             <li class="page-item disabled">
//               <a class="page-link" href="#">Previous</a>
//             </li>
//             ';
//         }

//         //next function
//         $next_id = $page_array[$count] + 1;
//         if($next_id >= $total_links){
//             $next_link = '
//             <li class="page-item disabled">
//               <a class="page-link" href="#">Next</a>
//             </li>
//               ';
//         }else{
//             $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
//         }


//     }else{
//         if($page_array[$count] == '...'){
//             $page_link .= '
//             <li class="page-item disabled">
//                 <a class="page-link" href="#">...</a>
//             </li>
//             ';
//         }else{
//             $page_link .= '
//             <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
//             ';
//         }
//     }
// }

// $output .= $previous_link . $page_link . $next_link;
// $output .= '
//   </ul>

// </div>
// ';

echo $output;

?>
