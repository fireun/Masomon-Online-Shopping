<?php
    include '../config.php';

    if(isset($_POST['addSize'])){
        // $a = $_POST['valueOfSize'];
        $arar = $_POST['valueOfSize'];
        // echo  $_POST['valueOfSize'];
        // $checksize = array($_POST['valueOfSize']);

        // foreach ($checksize as $value) {
        //     echo'<script type=text/javascript>window.alert("';
        //     echo "$value";
        //     echo'")</script> ';
        // }

        // foreach ($_POST['valueOfSize'] as $key => $value) {
        //     $submitted_array = array_keys($_POST['valueOfSize']); 
        //     echo ($_POST['valueOfSize'][$submitted_array[0]] . " " . $submitted_array[0]); 
        // }

        // $checksize = $_POST['valueOfSize'];
        // print_r ($_POST['valueOfSize[]']);
        // foreach ($arar as $value) {
        //     echo "$value <br>";
        // }
        for($q=0; $q < count($arar); $q++){
            echo $arar[$q].'<br>';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/sellerstyle.css" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/tablestyle.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
     <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <?php require 'header.php' ?>
    <div class="content">
        <aside class=""> 
                <div class="container" style="padding:20px">
                    <form action="createProductImage.php" method="post">
        
                        <div class="create-product-tab-box">
                            <h3>Product Variation</h3>
                            <!-- view -->
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Variation</label>
                                </div>
                                <div class="col-75">
                                    <div id="displayValue"></div>
                                </div>
                            </div>
                            <!-- add -->
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Input variation</label>
                                </div>                           
                                <div class="col-75">
                                    <input type="text" name="size" id="sizevalue" placeholder="key in variation for product" style="width:25%">
                                    <input type="button" name="" id="addSize" value="Add variation" style="height:43px" onclick="getChoice()">
                                    <button type="submit" name="addSize">Check</button>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <button type="submit" class="submit-btn"><i class='fas fa-arrow-left' style="padding-left:12px;font-size:15px"></i>Back</button>
                                <button type="submit" class="submit-btn">Cancel</button>
                                <button type="submit" class="submit-btn">Next<i class='fas fa-arrow-right' style="padding-left:12px;font-size:15px"></i></button>
                            </div> -->
                        </div><!--End second page-->
                    </form>
            </div>
        </aside>
    </div>
    <?php require 'footer.php' ?>
</body>
<script src="../js/sellerscript.js"></script>
<script>
  
  function getChoice(){
        var btn = document.createElement("input");//html tag
        btn.innerHTML = document.getElementById("sizevalue").value;//get value
        btn.id = 'sizeValue1';
        btn.className = 'siza-value1';
        btn.name = 'valueOfSize[]';
        btn.style.float = 'left';
        btn.style.width = '50px';
        btn.style.margin = '0px 0px 0px 10px';
        btn.setAttribute("value", document.getElementById("sizevalue").value);//keep value in btn
        btn.setAttribute("readonly", "true");//read only
        document.getElementById('displayValue').appendChild(btn);

        // var str1 = "<li><button style='font-size:20px'>";
        // var str2 = "<i class='fas fa-times hovertimes' title='remove'></i></button></li>";
        // var met = document.getElementById('displayValue').innerHTML(strId);
        // var strId = document.getElementById("sizevalue").value;//get value
        // // var met = str1+strId+str2;
        // // console.log(strId);
        // document.getElementById('displayValue').appendChild(met);
     }
    
//   var isautionProduct = document.getElementById('#autionProduct');
//   var noautionProduct = doument.getElementById('#noautionProduct').selected = true;
</script>
</html>

