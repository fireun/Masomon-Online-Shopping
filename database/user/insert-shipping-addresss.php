<?php

include("../../config.php");
session_start();

$generateShipId = uniqid();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");
$output='';

    if(!empty($_POST["createName"]))  
    {  
        $output       = ''; 
        $name         = mysqli_real_escape_string($conn, $_POST["createName"]); 
        $phone        = mysqli_real_escape_string($conn,$_POST['createPhoneNo']); 
        $address      = mysqli_real_escape_string($conn, $_POST["createAddress"]);  
        $city         = mysqli_real_escape_string($conn, $_POST["createCity"]);  
        $State        = mysqli_real_escape_string($conn, $_POST["createState"]);  
        $postalCode   = mysqli_real_escape_string($conn, $_POST["createPostalCode"]);  
        $country      = mysqli_real_escape_string($conn,$_POST['createCountry']);

        // if($_SESSION['userId'] == ''){  
            //   $query = "  
            //   UPDATE tbl_employee   
            //   SET name       ='$name',   
            //   address        ='$address',   
            //   gender         ='$gender',   
            //   designation    = '$designation',   
            //   age            = '$age'   
            //   WHERE id='".$_POST["employee_id"]."'";  
            //   $message       = 'Data Update has been Successfully!';  
          // }  
        // }else {  
            $userId = $_SESSION['userId'];
            $query = "  
            insert into address_shipping(ship_id,recipient_name, recipient_phone, recipient_address, recipient_city, recipient_state,
            recipient_postalCode, recipient_country, user_id,status, created_time, update_time)  
            VALUES('$generateShipId','$name','$phone', '$address','$city' ,'$State','$postalCode','$country','$userId','1', '$date', '$date');  
            ";  
            $createResult=$conn->query($query);
      
        

        if($createResult == true){  
            $_SESSION['m_last_action'] = time();      
            $_SESSION['m'] = "creted-address-success-01";
            $_SESSION['newShipId'] = $generateShipId;

            //   $output .= '<label class="text-success">' . $message . '</label>';  
            $select_query = "SELECT * FROM address_shipping where ship_id = '$generateShipId' and user_id = '$userId'";  
            $result = mysqli_query($conn, $select_query);    
            while($row = mysqli_fetch_array($result)) {
                $output .= '
                    <div class="col-sm-3">
                        <span>' . $row["recipient_name"] . '</span>
                        <input type="hidden" name="user" class="custom-input-border custome-cursor-default" value="' . $row["recipient_name"] . '">
                    </div>
                    <div class="col-sm-2">
                        <span> (+' . $row["recipient_phone"] . ')</span>
                        <input type="hidden" name="address" class="custom-input-border custome-cursor-default" value=" (+' . $row["recipient_phone"] . ')">
                    </div>
                    <div class="col-sm-6">
                        <span>' . $row["recipient_address"] . ',' . $row["recipient_city"] . ',' . $row["recipient_postalCode"] . ',' . $row["recipient_country"] . '</span>
                        <input type="hidden" name="address" class="custom-input-border custome-cursor-default" value="' . $row["recipient_address"] . ',' . $row["recipient_city"] . ',' . $row["recipient_postalCode"] . ',' . $row["recipient_country"] . '">
                    </div>
                ';  
            }
            echo $output;
        }  
    }else if($_POST['newShipId']){
        $output       = ''; 
        $_SESSION['newShipId']  = mysqli_real_escape_string($conn, $_POST["newShipId"]); 
        $_SESSION['m'] = "creted-address-success-02";
        $_SESSION['m_last_action'] = time();      
        echo $output;
    }

?>