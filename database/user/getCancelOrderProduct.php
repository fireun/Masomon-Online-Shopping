<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");
$output='';

    if(!empty($_POST["orderId"]))  
    {  
        $output       = ''; 
        $user_id = $_SESSION['userId'];
        $order_Id = mysqli_real_escape_string($conn, $_POST["orderId"]); 

            $select_query = "SELECT * FROM orderlist LEFT JOIN cartintegration ON orderlist.cartId = cartintegration.cartId LEFT JOIN product ON cartintegration.productId = product.id WHERE orderlist.orderId = '$order_Id' AND cartintegration.cancelRequest = '0' AND cartintegration.returnRequest = '0' AND orderlist.userId = '$user_id'";  
            $result = mysqli_query($conn, $select_query);   
            while($row = mysqli_fetch_array($result)) { 
                $cartIntegrationId = $row['cartIntegrationId'];

                $checkAvailableCancel = "SELECT * FROM `actioncenter` WHERE cartIntegrationId = '$cartIntegrationId'";
                $resultCheckAvailableCancel = $conn->query($checkAvailableCancel);
                if($resultCheckAvailableCancel->num_rows>0){
                
                }else{
                    //short name
                    if( strlen( $row["name"] ) > 30 ) {
                        $row["name"] = substr( $row["name"], 0, 30 ) . '...';
                    }

                $output .= '
                    <div class="row">
                        <div class="col-1 pt-5 pl-3">
                            <input type="radio" value="' . $row["cartIntegrationId"] . '" name="cancelOption" aria-label="Checkbox for following text input">
                        </div>
                        <div class="col-3">
                            <img src="../images/productImage/' . $row["coverImage"] . '" alt="" class="w-100 h-100">
                        </div>
                        <div class="col-5">
                            <h5>' . $row["name"] . '</h5>
                        </div>
                        <div class="col-3">
                            <h5>RM ' . $row["price"] . '</h5>
                        </div>
                    </div>
                    <br>

                ';  
                }
            }
            echo $output;
        }  
?>