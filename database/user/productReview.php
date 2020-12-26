<?php
include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d H:i:s");
$output='';


if(isset($_POST['methodAction'])){
    $productId = $_POST['productId'];
    $display = "SELECT rating.*, comment.*, user.image, user.userName, rating.created_time AS 'ratingDate', cartintegration.variation FROM rating LEFT JOIN comment ON rating.commentId = comment.commentId LEFT JOIN user ON rating.userId = user.userId LEFT JOIN cartintegration ON rating.cartIntegrationId = cartintegration.cartIntegrationId WHERE rating.productId = '$productId' GROUP BY rating.ratingId ORDER BY rating.ratingValue DESC";
    
    $resultDisplay = $conn->query($display);

    if($resultDisplay->num_rows>0){
        while($row = mysqli_fetch_array($resultDisplay)){
            $user_image = $row["image"];
            if($user_image == NULL){
                $user_image = "userIcon.png";
            }
            
            $output .= '

            <div class="post-container shadow-sm p-3 mb-3 bg-light rounded">
                <img src="../images/profileImage/' . $user_image . '" alt="user" class="profile-photo-md pull-left">
                <div class="post-detail">
                    <div class="user-info">
                        <h5>
                            <a class="profile-link text-info">' . $row["userName"] . '</a> 
                            <span class="following">
            ';
            $rating_value = $row['ratingValue'];
            if($rating_value == "5"){
                $output .='
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                ';
            }else if($rating_value == "4"){
                $output .='
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                ';
            }else if($rating_value == "3"){
                $output .='
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                ';
            }else if($rating_value == "2"){
                $output .='
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                ';
            }else if($rating_value == "1"){
                $output .='
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                ';
            }
            $output .='
                            </span>
                        </h5>
                        <p class="text-muted">Published a photo about ' . $row["ratingDate"] . '</p>
                    </div>
                    <div class="line-divider"></div>
                    <div class="post-text">
                        <p>' . $row["commentText"] . ' <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                    </div>
                    <div class="post-comment">
                        <div class="row ml-2">
            ';
            $ratingID =  $row["ratingId"];
            $commentID = $row["commentId"];
            $variation = $row["variation"]; //经过sql会消失 so need declare variable
            $getImage = "SELECT * FROM feedback_image WHERE feedback_sourceId = '$commentID'";
            $resultGetImage = $conn->query($getImage);

            if($resultGetImage->num_rows>0){
                while($row = mysqli_fetch_array($resultGetImage)){
                    $filetype = $row['feedback_filetype'];
                    if($filetype == "video"){                                
            $output .='
                            <div class="mr-2" style="">
                                <video src="../images/feedback-images/' . $row["feedback_location"] . '" controls width="140" height="100">
                            </div>
                    ';
                    }else if($filetype == "image"){
            $output .='
                            <div class="mr-2" style="">
                                <img src="../images/feedback-images/' . $row["feedback_location"] . '" alt="" class="" width="140" height="100">
                            </div>
                    ';  
                    }
                }
            }
            $output .='
                        </div>
                    </div>
                    <div class="line-divider"></div>
                    <div class="post-comment">
                        <div class="ml-2">
                            <h5>Variation: <small> ' . $variation . '</small></h5>         
                        </div>
                        <div class="col">
                            <!-- <a type="button" data-toggle="modal" data-target="#EditPostModal" class="ml-2 ml-2 text-decoration-none text-info" id="EditPostBtn">Edit Post</a> -->
                            <input type="hidden" id="EditPostRatingId" value="' . $ratingID . '">
                        </div>
                    </div>
                    ';

            $checkExistComment = "SELECT comment.*, user.userName, user.image AS 'userImage', seller.sellerName, seller.image AS 'sellerImage', comment.created_time AS 'replyDate' FROM COMMENT LEFT JOIN user ON comment.comment_personId = user.userId LEFT JOIN seller ON comment.comment_personId = seller.sellerId WHERE comment.ratingId = '$ratingID' AND comment.commentId != '$commentID' ORDER BY comment.created_time DESC";
            $resultCheckExistComment = $conn->query($checkExistComment);

            if($resultCheckExistComment->num_rows>0){
                while($row = mysqli_fetch_array($resultCheckExistComment)){
                    $comment_username = $row['userName'];
                    $comment_userImage = $row['userImage'];
                    $comment_sellerName = $row['sellerName'];
                    $comment_sellerImage = $row['sellerImage'];
                    $commentDate = $row['replyDate'];
                    $newcomment_commentID = $row['commentId'];

                    if($comment_userImage == NULL){
                        $comment_userImage = "userIcon.png";
                    }else if($comment_sellerImage == NULL){
                        $comment_sellerImage = "userIcon.png";
                    }

                    if($comment_sellerName == NULL){
            $output .='
                    <div class="post-comment">
                        <img src="../images/profileImage/' . $comment_userImage . '" alt="" class="profile-photo-sm">
                        <p class="text-dark c">
                            <a class="profile-link text-info">' . $comment_username . ' </a> 
                            <span style="color:grey" class="font-weight-normal">' . $commentDate . '</span> 
                            <br>
                            ' . $row["commentText"] . '  
                        </p>
                    </div>
                    ';
                    }else if($comment_username == NULL){
            $output .='
                    <div class="post-comment">
                        <img src="../images/profileImage/' . $comment_sellerImage . '" alt="" class="profile-photo-sm">
                        <p class="text-dark font-weight-bold">
                            <a class="profile-link text-info">' . $comment_sellerName . '</a> 
                            <span style="color:grey" class="font-weight-normal">' . $commentDate . '</span>
                            <br> 
                            ' . $row["commentText"] . '  
                        </p>
                    </div>
                    ';
                    }
            //check Available push image
            $checkNewCommentMedia = "SELECT comment.*, feedback_image.* FROM `comment` LEFT JOIN `feedback_image` ON feedback_image.feedback_sourceId = comment.commentId WHERE comment.ratingId = '$ratingID' AND feedback_image.feedback_sourceId = '$newcomment_commentID'";
            $resultCheckNewCommentMedia = $conn->query($checkNewCommentMedia);
            if($resultCheckNewCommentMedia->num_rows > 0){
                $output .='
                    <div class="post-comment">
                        <div class="row ml-3">
                    ';
                while($row = $resultCheckNewCommentMedia->fetch_assoc()){
                    if($row['feedback_filetype'] == "image"){
                        $output .='
                                <div class="mr-2">
                                    <img src="../images/feedback-images/'. $row["feedback_location"] .'" alt="'. $row["feedback_location"] .'" class="mt-2" width="140" height="100">
                                </div>
                        ';     
                    }else if($row['feedback_filetype'] == "video"){
                        $output .='
                                <div class="mr-2 ">
                                    <video src="../images/feedback-images/'. $row["feedback_location"] .'" controls width="140" height="100">
                                </div>
                        ';   
                    }
                }//end other comment media
                $output .='
                        </div>
                    </div>
                    ';
            }//end check if

                }//end loop check other comment
            }//end if have other comment

            $user_image = "userIcon.png";
            $userId  = " ";
            if(isset($_SESSION['userId'])){
                $userId = $_SESSION['userId'];
                $getUserImage = "SELECT image FROM user WHERE userId = '$userId'";
                $resultGetUserImage = $conn->query($getUserImage);

                if($resultGetUserImage->num_rows>0){
                    while($row = mysqli_fetch_array($resultGetUserImage)){
                        $user_image = $row['image'];

                        if($user_image == NULL){
                            $user_image = "userIcon.png";
                        }
                        $output .='
                        <form method="POST" action="../database/user/insertNewComment.php?ratingId=' . $ratingID . '&userId=' . $userId . '" enctype="multipart/form-data">
                        <div class="post-comment input-group mb-3">
                            <img src="../images/profileImage/' . $user_image . '" alt="" class="profile-photo-sm">
                            <div class="input-group" style="width:90%">
                              <input type="text" class="form-control" name="commentText" placeholder="Post A New Comment... ">
                              <div class="input-group-append h-75" style="margin-top:0.4rem">
                                  <button type="submit" name="postNewComment" style="color: #4e73df;border-color: #4e73df;">Submit</button>
                                  <input type="file" name="commentFeedback[]" class="color: #4e73df;border-color: #4e73df;" id="inputCommentFile" max-file-size="6" multiple accept="image/*, video/*" onchange="return checkFile(this);">
                              </div>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
                        ';
                
                    }
                }
            }else{            
            $output .='
                    <div class="post-comment input-group mb-3">
                        <img src="../images/profileImage/' . $user_image . '" alt="" class="profile-photo-sm">
                        <input type="text" class="form-control" name="insertReply" placeholder="Post a comment" aria-label="post a comment" aria-describedby="button-addon2" onkeyup="keyupGetInput(this)">
                        <div class="input-group-append">
                            <button class="btn btn-secondary h-75 submitReplyPost" type="button" data-rating="'. $ratingID .'" data-user="'. $userId .'" onclick="postNewReply(this)">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
                    ';
            }
        } //end while

        echo $output;
    }//end if

//end this method
}


