<?php 
    include("../config.php");
    session_start();

    $warningText = "UnComplete! Please edit your profile";

    if(isset($_SESSION['sellerId'])){
        $sid = $_SESSION['sellerId'];

        $getData = "select * from seller where sellerId='$sid'";
        $result = $conn->query($getData);
        if($result->num_rows > 0){ //over 1 database(record) so run
            while($row = $result->fetch_assoc()){
                // $id=$row['sellerId'];
                $name=$row['sellerName'];
                $email=$row['email'];
                $phoneNo=$row['phoneNo'];
                $gender=$row['gender'];
                $image=$row['image'];
                $address=$row['address'];
                $city=$row['city'];
                $state=$row['state'];
                $postalCode=$row['postalCode'];
                $businessType=$row['businessType'];
                $bankName=$row['bankName'];
                $accountNo=$row['accountNo'];               
                
                if(empty($email)){
                    $email = $warningText;
                }
                if(empty($phoneNo)){
                    $phoneNo = $warningText;
                }
                if(empty($gender)){
                    $gender = $warningText;
                }
                if(empty($address)){
                    $address = $warningText;
                }
                if(empty($city)){
                    $city = $warningText;
                }
                if(empty($state)){
                    $state = $warningText;
                }
                if(empty($postalCode)){
                    $postalCode = $warningText;
                }
                if(empty($businessType)){
                    $businessType = $warningText;
                }
                if(empty($bankName)){
                    $bankName = $warningText;
                }
                if(empty($accountNo)){
                    $accountNo = $warningText;
                }
            }
        }

          if(isset($_POST['upload'])){
                $uploads_place = '../images/profileImage/'; //images floder name destination
                $StoreName = basename($_FILES["sellerimage"]['name']);//original image name
                $Imagetarget = $uploads_place.$StoreName;//get destination + original image name
                

                //check move status
                if(move_uploaded_file($_FILES["sellerimage"]["tmp_name"],$Imagetarget)) {
                    // $imgseller = $_FILES['updatenewsellerimage']['name'];
                    $updateImageSql = "update seller set image='$StoreName' where sellerId = '$sid'";

                    //step 6 : Run SQL 
                    $resultupdateImageSql=$conn->query($updateImageSql);
                    if($resultupdateImageSql == true){
                        echo'<script type=text/javascript>window.alert("Upload Successfull !!!")</script> ';
                    }else{
                        echo'<script type=text/javascript>window.alert("Upload Failure !!!")</script> ';
                    }
                    
                }else {
                    echo'<script type=text/javascript>window.alert("no choose image")</script> ';
                }  
          }

    }else{ 
        // if no login
        $unloginMessage = "you must login first!";
        $name=$unloginMessage;
        $email=$unloginMessage;
        $phoneNo=$unloginMessage;
        $gender=$unloginMessage;
        $image=$unloginMessage;
        $address=$unloginMessage;
        $city=$unloginMessage;
        $state=$unloginMessage;
        $postalCode=$unloginMessage;
        $businessType=$unloginMessage;
        $bankName=$unloginMessage;
        $accountNo=$unloginMessage;
        // echo '<script>document.getElementByClassName(\'profile-edit-mode\').style.color = \'red\'</script>';
        echo '<script>window.alert("Please Login")</script>';//没有login
        header('refresh:0;url=./login.php');
        // header("location:./login.php");

    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 5 -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/sellerstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/profilestyle.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <?php require 'asideLeft.php' ?>
        <aside class="contentbar"> 
            <!-- 整个内容 -->
            <form action="profile.php" method="post" enctype="multipart/form-data">

                <div class="profile-box">

                    <!-- 左边的边框 -->
                    <div class="profile-box-left">
                        
                        <!-- 左上角image box -->
                        <div class="profile-image-box">
                            <div class="profile-box-left-image">
                                <div class="upload-image-box">
                                    <?php 
                                    if(isset($_SESSION['sellerId'])){
                                        if(empty($image)){
                                            echo "<img src=\"../images/userIcon.png\" id=\"my-img\" alt=\"\" width=100 height=100\>";
                                        }else{
                                            echo "<img src=\"../images/profileImage/$image\" id=\"my-img\" alt=\"\" width=100 height=100\>";
                                        }                                     
                                    }else {
                                        echo "<img src=\"../images/userIcon.png\" id=\"my-img\" alt=\"\" width=100 height=100\>";
                                    }
                                    ?>                                
                                    <div class="upload-image-input-box">
                                        Upload
                                        <input type="file" name="sellerimage" id="img-upload"
                                        accept=".jpg, .jpeg, .png" onchange="previewFile()"> <!--限制图片   only choose one pic-->
                                    </div>
                                </div>                   
                            </div>
                        </div>                    

                        <!-- 左边中间side bar -->
                        <div class="profile-box-left-tools">
                                <div class="images-upload-button-box" >
                                    <button type="submit" name="upload" class="upload-image-btn">Upload Image</button>
                                </div>
                                <div class="edit-box">
                                    <a href="./editProfile.php?sellerId=<?php echo $sid?>"><i class="fas fa-edit"></i> Edit Profile</a>
                                </div>
                        </div>

                    
                        <!-- <div class="upload-image-box">
                            <div></div>
                            <input type="file" name="images" class="upload-image-input">
                        </div>
                        -->
                    </div><!--End aside left -->
                    
                    <!-- 右边内容区 -->
                    <div class="profile-box-right">

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="username">UserName:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <input type="text" name="sname" class="profile-view-mode" placeholder="seller name/company name" value="<?php echo $name ?>"> -->
                                <label for="username" class="profile-edit-mode"><?php echo $name ?></label>
                            </div>
                        </div>

                        <!-- <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="firstname">FirstName:</label>
                            </div>
                            <div class="profile-col-75">
                                <input type="text" class="profile-view-mode" placeholder="firstname...">
                                <label for="username"><?php echo $firstname ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="lastname">LastName:</label>
                            </div>
                            <div class="profile-col-75">
                                <input type="text" class="profile-view-mode" placeholder="lastname...">
                                <label for="username"><?php echo $name ?></label>
                            </div>
                        </div> -->

                        <!-- <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="ic">IC/Passport Number:</label>
                                                </div>
                                                <div class="profile-col-75">
                                <input type="text" class="profile-view-mode" placeholder="IC/Passport Number...">
                                <label for="username"><?php echo $ic ?>:</label>
                            </div>
                        </div> -->

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="email">Email Address:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <input type="email" name="semail" class="profile-view-mode" placeholder="email address..." value="<?php echo $email ?>"> -->
                                <label for="username" class="profile-edit-mode"><?php echo $email ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="phone">Phone No:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <input type="number" name="sphone" class="profile-view-mode" placeholder="phone number..." oninput="if(value.length>11)value=value.slice(0,10)" value="<?php echo $phoneNo ?>"> -->
                                <label for="username" class="profile-edit-mode"><?php echo $phoneNo ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="address">Address</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <input type="text" name="sadd" class="profile-view-mode" placeholder="address..." value="<?php echo $address ?>"> -->
                                <label for="username" class="profile-edit-mode"><?php echo $address ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="gender">Gender:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <div class="profile-view-mode">                                
                                    <input type="radio" id="male" name="sgender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">
                                    <label for="male">Male</label><br>
                                    <input type="radio" id="female" name="sgender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">
                                    <label for="female">Female</label><br>
                                </div>                          -->
                                <label for="username" class="profile-edit-mode"><?php echo $gender ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="city">City:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <select name="scity" id="city" class="profile-view-mode">
                                    <option value="kl">Kuala Lumpur</option>
                                    <option value="jb">Putrajays</option>
                                    <option value="selangor">kuching</option>
                                    <option value="audi">malaca</option>
                                </select> -->
                                <label for="username" class="profile-edit-mode"><?php echo $city ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="status">State:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <select name="sstate" id="state" class="profile-view-mode">
                                    <option value="kl">Kuala Lumpur</option>
                                    <option value="jb">Sabah</option>
                                    <option value="selangor">Sarawak</option>
                                    <option value="audi">Johor</option>
                                    <option value="">Kedah</option>
                                </select> -->
                                <label for="username" class="profile-edit-mode"><?php echo $state ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="spos">Postal Code:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <input type="number" class="profile-view-mode" name="" id="" oninput="if(value.length>11)value=value.slice(0,5)"  placeholder="Postal Number"> -->
                                <label for="username" class="profile-edit-mode"><?php echo $postalCode ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="BT">Business Type:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <select name="stype" id="businessType" class="profile-view-mode">
                                    <option value="p">Personal</option>
                                    <option value="b">Business</option>
                                    <input type="text" class="profile-view-mode" name="companyName" placeholder="company name..." value="<?php echo $companyName ?>"> 
                                </select>  -->
                                <label for="username" class="profile-edit-mode"><?php echo $businessType ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="bank">Bank Name:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <select name="sbank" id="bank" class="profile-view-mode">
                                    <option value="<?php echo $bankName ?>"></option>
                                    <option value="p">Maybank2U</option>
                                    <option value="b">HongLeong Bank</option>
                                </select> -->
                                <label for="username" class="profile-edit-mode"><?php echo $bankName ?></label>
                            </div>
                        </div>

                        <div class="profile-box-row">
                            <div class="profile-col-25">
                                <label for="sacc">Account Number:</label>
                            </div>
                            <div class="profile-col-75">
                                <!-- <input type="number" class="profile-view-mode" name="" id="" oninput="if(value.length>11)value=value.slice(0,12)"  placeholder="XXXXXXXXXXXX" value="<?php echo $accountNo ?>"> -->
                                <label for="username" class="profile-edit-mode"><?php echo $accountNo ?></label>
                            </div>
                        </div>

                        <!-- <div class="actionBtn">
                            <button type="submit" name="Update" class="profile-view-mode"><i class="fas fa-upload"></i> Update</button>
                        </div> -->
                        </div><!--End right Box-->

                    
                </div><!--End content-->
        </form>
        </aside>
    </div>       

    <!-- footer -->
    <?php require './footer.php' ?>

    <script src="../js/sellerscript.js"></script>
    <script src="../js/sellerProfileScript.js"></script> 
    <script>
        //view image before upload 
        function previewFile() {
            var preview = document.getElementById('my-img');//image layout place
            var file    = document.querySelector('input[type=file]').files[0];//input type[file]
            var reader  = new FileReader();
        
            reader.onloadend = function () {
                preview.src = reader.result;
            }
        
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
</body>
</html>

