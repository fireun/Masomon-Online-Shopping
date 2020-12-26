<?php
include("../../config.php");
session_start();


date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");

if(isset($_POST['reviewInsert'])){
    $generateRatingId = uniqid("Rating-");
    $generateCommentId = uniqid("Comment-");
    $cartIntegrationId = $_POST['cartIntegrationId'];
    $productId = $_POST['productId'];
    $userId = $_SESSION['userId'];
    $ratingValue = $_POST['selected_rating'];
    $commentText = $_POST['commentText'];
    

    //3 table to insert 
    //1. rating
    $insertRating = "INSERT INTO rating (ratingId, userId, commentId, cartIntegrationId, productId, ratingValue, created_time, update_time)
    VALUES ('$generateRatingId', '$userId', '$generateCommentId', '$cartIntegrationId', '$productId', '$ratingValue', '$date', '$date')";
    //2. comment
    $insertComment= "INSERT INTO comment (commentId, ratingId, comment_personId, commentText, created_time, update_time)
    VALUES ('$generateCommentId', '$generateRatingId', '$userId', '$commentText', '$date', '$date')";
    //3. feedback-image
    if(!empty($_FILES['input44']['name'][0])){

        foreach($_FILES['input44']['name'] as $key=>$insertFile){
            $generateFeedbackId = uniqid("Feedback-");

            $target_dir = '../../images/feedback-images/'; //images floder name destination
            $target = $target_dir.$insertFile;//get destination + original image name
            $images_extensions_arr = array("jpg","jpeg","png","gif");
            $video_extensions_arr = array("mp4","avi","3gp","mov","mpeg","wma");

            $getFileType = pathinfo($_FILES['input44']['name'][$key],PATHINFO_EXTENSION); //get file type

            if( in_array($getFileType,$video_extensions_arr) ){
                $filetype = "video";
            }else if( in_array($getFileType,$images_extensions_arr) ){
                $filetype = "image";
            }else{
                echo "<script>window.history.back();</script>";//wrong file type
            }

            if(move_uploaded_file($_FILES['input44']['tmp_name'][$key], $target)){
                // Insert record
                $insertImage = "INSERT INTO feedback_image(feedbackId, feedback_sourceId, feedback_location, feedback_fileType,created_time, update_time) VALUES('".$generateFeedbackId."','".$generateCommentId."','".$insertFile."', '".$filetype."', '".$date."','".$date."')";
                $resultInsertImage =$conn->query($insertImage);
            }
        }   
    }
    $resultInsertRating =$conn->query($insertRating);
    $resultInsertComment =$conn->query($insertComment);
    
    if($resultInsertRating && $resultInsertComment == true){
        echo "<script>window.location.assign('../../user/purchasePage.php');</script>";//Reload this page or go to hyperlink page
    }
}