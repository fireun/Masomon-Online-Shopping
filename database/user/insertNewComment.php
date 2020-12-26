<?php
include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");
$output='';

//Assign the current timestamp as the user's
//latest activity
if( ($_GET['ratingId'] != NULL) && ($_GET['userId'] != NULL) && ($_POST['commentText'] != NULL) ){
    $insert_generate_comment_id = uniqid("Comment-");
    $insert_comment_text = $_POST['commentText'];
    $insert_rating_id = $_GET['ratingId'];
    $insert_user_id = $_GET['userId'];

    
    $insertSql = "INSERT INTO comment(commentId, ratingId, comment_personId, commentText, created_time, update_time) VALUES ( '$insert_generate_comment_id', '$insert_rating_id', '$insert_user_id', '$insert_comment_text', '$date', '$date')";
    $resultInsertSql = $conn->query($insertSql);
    if($resultInsertSql == true){

        //check if insert media
        if(!empty($_FILES['commentFeedback']['name'][0])){

            foreach($_FILES['commentFeedback']['name'] as $key=>$insertFile){
                $feedback_media_id = uniqid("Feedback-");
                $filetype = " ";
            
                $target_dir = '../../images/feedback-images/'; //images floder name destination
                $target = $target_dir.$insertFile;//get destination + original image name
                $images_extensions_arr = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF");
                $video_extensions_arr = array("mp4","mp3","avi","3gp","mov","mpeg","wma","MP4","MP3","AVI","3GP","MOV","MPEG","WMA");
            
                $getFileType = pathinfo($_FILES['commentFeedback']['name'][$key],PATHINFO_EXTENSION); //get file type
                
                if( in_array($getFileType,$video_extensions_arr) ){
                    $filetype = "video";
                }else if( in_array($getFileType,$images_extensions_arr) ){
                    $filetype = "image";
                }else{
                    $_SESSION['m_last_action'] = time();
                    $_SESSION['m'] = "insert-comment-image-media-type-invalid-notic-01";
                    echo "<script>window.history.back();</script>";//wrong file type
                }
            
                if(move_uploaded_file($_FILES['commentFeedback']['tmp_name'][$key], $target)){
                    // Insert record
                    $insertImage = "INSERT INTO `feedback_image`(`feedbackId`, `feedback_sourceId`, `feedback_location`, `feedback_filetype`, `created_time`, `update_time`) VALUES ('$feedback_media_id','$insert_generate_comment_id','$insertFile','$filetype','$date','$date')";
                    $resultInsertImage =$conn->query($insertImage);
                }
            }   
        } //end check empty media 

        $_SESSION['m_last_action'] = time();      
        $_SESSION['m'] = "Insert-New-Post-Success-01";
        echo "<script>window.history.back()</script>";


    }

}else{
    $_SESSION['m_last_action'] = time();
    $_SESSION['m'] = "Insert-New-Post-Failed-Value-Lost-01";
    echo "<script>window.history.back()</script>";
}
