<?php

include("../config.php");
session_start();

// require_once '../database/user/auctionCheck.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Auction Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
  <link rel="icon" sizes="16x16" type="image/png" href="../images/favicon.png"/>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/homestyle.css">
  <link rel="stylesheet" href="../css/userproduct.css">

  
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>

<?php require '../user/header.php' ?>

    <div class="product-page-container col-md-12 pt-10">
    <form method="post" id="AuctionSelectForm">
        <div class="row" id="selectBox">
            <!-- <h3>Large Buttons:</h3> -->
            <!-- <div class="btn-group btn-group-lg"> -->
                <button type="button" class="btn btn-outline-danger btn-lg col buttonClick active buttonClick" value="ALL" id="all">View All</button>
                <button type="button" name="today" class="btn btn-outline-danger btn-lg col buttonClick" value=" " id="today"></button>
                <button type="button" name="tomorrow" class="btn btn-outline-danger btn-lg col buttonClick" value=" " id="tommorrow"></button>
                <button type="button" name="aft" class="btn btn-outline-danger btn-lg col buttonClick" value=" " id="aft"></button>
                <button type="button" name="afftt" class="btn btn-outline-danger btn-lg col buttonClick" value=" " id="afftt"></button>
                <button type="button" name="afffttt" class="btn btn-outline-danger btn-lg col buttonClick" value=" " id="afffttt"></button>
            <!-- </div>  -->
        </div>
    </form>

        <hr>
        <div class="row" style="margin:0%" id="dynamic_content">
   
        </div>

    </div>

<?php require '../user/footer.php'?>
</body>
<script src="../js/homescript.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script><!--Ajaxx-->
<script>
    var currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    // console.log(currentDate);
    var day = currentDate.getDate()
    var month = currentDate.getMonth() + 1
    var year = currentDate.getFullYear()
    // document.write("<b>" + day + "/" + month + "/" + year + "</b>")

    document.getElementById("today").innerHTML =  "Today "+(day-1 + "/" + month + "/" + year);
    $('#today').val(year + "-" + month + "-" + (day-1)); //setter

    document.getElementById("tommorrow").innerHTML =  "Tomorrow "+(day + "/" + month + "/" + year);
    $('#tommorrow').val(year + "-" + month + "-" + day); //setter

    document.getElementById("aft").innerHTML =  day+1 + "/" + month + "/" + year;
    $('#aft').val(year + "-" + month + "-" + (day+1)); //setter

    document.getElementById("afftt").innerHTML =  day+2 + "/" + month + "/" + year;
    $('#afftt').val(year + "-" + month + "-" + (day+2)); //setter

    document.getElementById("afffttt").innerHTML =  day+3 + "/" + month + "/" + year;
    $('#afffttt').val(year + "-" + month + "-" + (day+3)); //setter
    

    // Add active class to the current button (highlight it) -- toggle button
    var header = document.getElementById("selectBox");
    var btns = header.getElementsByClassName("btn");
    var current = document.getElementsByClassName("active");

    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }


    //get data
    $(document).ready(function(){

        load_data();

        function load_data(chooseDate = 'ALL' )
        {
        $.ajax({
            url:"../database/user/ShowAuction.php",
            method:"POST",
            data:{chooseDate:chooseDate}, //this is what data send between hyperlink
            success:function(data)
            {
            $('#dynamic_content').html(data); //show in this dynaimic_content place
            }
        });
        }

        $(".buttonClick").click(function () {
            if (this.id == 'all') {
                $('#all').val();
                // console.log( $('#all').val());
                load_data($('#all').val());

            }else if (this.id == 'today') {
                $('#today').val();
                load_data($('#today').val());

            }else if (this.id == 'tommorrow') {
                $('#tommorrow').val();
                load_data($('#tommorrow').val());

            }else if (this.id == 'aft') {
                $('#aft').val();
                load_data($('#aft').val());

            }else if (this.id == 'afftt') {
                $('#afftt').val();
                load_data($('#afftt').val());

            }else if (this.id == 'afffttt') {
                $('#afffttt').val();
                load_data($('#afffttt').val());
            }

        });
        
    });

    $(document).ready(function(){
        $('#searchProductBtn').click(function(){
            var keyword = $('#inputKeyword').val();
            window.location.href = "../user/searchProduct.php?query="+keyword;
        });

    });
</script>
</html>