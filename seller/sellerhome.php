<?php
    include("../config.php");
    session_start();

    // if(isset($_POST['logout'])){
    //     session_destroy();
    //     header("location:./login.php");
    // }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DashBoard</title>
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 5 -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/sellerstyle.css">
    <link rel="stylesheet" href="../css/footer.css">

</head>
<body>
    <?php require 'header.php' ?>
    
    <div class="content"  style="height:400px">
        <?php require 'asideLeft.php' ?>

        <aside class="contentbar">

            <div class="content-area">

                <div class="data-record-box">
                        <div class="data-box total-sale-box">
                            <h2>000</h2><br>
                            <p>Total Sale</p>
                        </div>
                        <div class="data-box montly-sale-box">
                            <h2>000</h2><br>
                            <p>Monthly Sale</p>
                        </div>
                        <div class="data-box top-sale-box">
                            <h2>000</h2><br>
                            <p>Top Sale Product</p>
                        </div>
                        <div class="data-box retuen-box">
                            <h2>000</h2><br>
                            <p>Return and Refund</p>
                        </div>
                </div>

                <!-- <div class="data-record-box">
                        <div class="data-box total-sale-box">
                            <h2>000</h2><br>
                            <p>Total Sale</p>
                        </div>
                        <div class="data-box montly-sale-box">
                            <h2>000</h2><br>
                            <p>Monthly Sale</p>
                        </div>
                        <div class="data-box top-sale-box">
                            <h2>000</h2><br>
                            <p>Top Sale Product</p>
                        </div>
                        <div class="data-box retuen-box">
                            <h2>000</h2><br>
                            <p>Return and Refund</p>
                        </div>
                </div> -->
            </div>
        </aside>
    </div>        

    <?php require 'footer.php' ?>


<script type="text/javascript" src="../js/sellerscript.js"></script>
<!-- <script>
    // When the user scrolls the page, execute myFunction
    // window.onscroll = function() {myFunction()};

    // // Get the header
    // var header = document.getElementById("navbar");

    // // Get the offset position of the navbar
    // var sticky = header.offsetTop;

    // // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    // function myFunction() {
    // if (window.pageYOffset > sticky) {
    //     header.classList.add("sticky");
    // } else {
    //     header.classList.remove("sticky");
    // }
    // }
</script> -->
</body>
</html>