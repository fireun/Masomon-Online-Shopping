<?php
include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");
$output='';


if(isset($_POST['ratingId'])){
    $ratingId = $_POST['ratingId'];
    $getPost = "SELECT *,rating.update_time AS 'postDate' FROM rating LEFT JOIN comment ON rating.commentId = comment.commentId LEFT JOIN feedback_image ON feedback_image.feedback_sourceId = comment.commentId WHERE rating.ratingId = '$ratingId'";
    $resultGetPost = $conn->query($getPost);

    if($resultGetPost->num_rows>0){
        while($row = mysqli_fetch_array($resultGetPost)){
            $output .= '

            <div class="row">
                <label class="control-label" for="rating">
                    <span class="field-label-header">According to your personal opinion, how many stars do you think the product can give? (1-5)</span><br>
                    <span class="field-label-info"></span>
                    <input type="hidden" id="modal_input_select_rating" name="selected_rating" value="' . $row["ratingValue"] . '" required>
                </label>
                <br>
                <button type="button" class="modalbtnrating btn btn-default btn-lg" data-modal-attr="1" id="modal-rating-star-1">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="modalbtnrating btn btn-default btn-lg" data-modal-attr="2" id="modal-rating-star-2">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="modalbtnrating btn btn-default btn-lg" data-modal-attr="3" id="modal-rating-star-3">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="modalbtnrating btn btn-default btn-lg" data-modal-attr="4" id="modal-rating-star-4">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="modalbtnrating btn btn-default btn-lg" data-modal-attr="5" id="modal-rating-star-5">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>

                <h2 class="bold rating-header ml-3 " style="">
                    <span class="modal_selected-rating" style="font-size:35px">' . $row["ratingValue"] . '</span><small> / 5</small>
                </h2>
                </div>
            <div class="row mt-2">
                <textarea placeholder="' . $row["commentText"] . '" name="commentText" cols="86" rows="5" id="modalCheckChar"  minlength="5" maxlength="250" required ></textarea>        
            </div>
            <div class="row float-right">
                <div class="float-right">( <span id="modalCalChar">0</span>/ 250)</div>           
            </div>
                '; 

            // $postDate = $row['postDate'];
            // $filename = $row['feedback_location'];
            // $filetype = $row['feedback_filetype'];
            // $rating_Id = $row['ratingId'];
            // $rating_comment_Id = $row['commentId'];
            // $rating_value = $row['ratingValue'];
            // $rating_Date = $row['ratingDate'];
            // $rating_comment_text = $row['commentText'];
            // $rating_cartIntegration_variation = $row['variation'];
            
        }
        echo $output;
    }
}else{

}
