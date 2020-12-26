<style>
.logout-modal {
     display: none;/* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  /* Modal Content/Box */
  .logout-modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 20%; /* Could be more or less, depending on screen size */
    box-shadow: 0px 0px 7px #1b1818;
  }
  
  /* The Close Button */
  .logout-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .logout-close:hover,
  .logout-close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

  .logout-modal-footer{
      width: 100%;
      height: 50px;
  }

  .logout-modal-footer button {
    width: 70px;
    height: 35px;
    border: 0px;
    background-color: #efefef;
  }
  
  .logout-modal-footer button:hover {
      cursor:pointer;
      outline:none;
      background-color:#999;
      color:white;
  }

  .logout-modal-footer button:nth-child(1) {
      margin-left: 63px;
  }
 
</style>

    <div class="navbar" id="navbar">
            <div class="topnav" id="myTopnav">
                <a href="sellerhome.php" class="logobox active header" title="DashBoard">
                </a>
                <a href="#contact" class="header">Contact</a>
                <div class="dropdown">
                    <button class="dropbtn">Account 
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <?php 
                         if(isset($_SESSION['sellerId'])){?>
                            <a href="../seller/profile.php" class="dropBtn-a">Profile</a>
                         <?php
                         }else{?>
                            <a href="login.php" class="dropBtn-a">Login</a>
                         <?php
                         }?>
                        <!-- <a href="#">Link 3</a> -->
                    </div>
                </div> 
                
                <div class="navbar-right-box">
                    <div class="account-info" id="showAccountBox">
                        <?php
                            if(isset($_SESSION['sellerId'])){
                                $sid = $_SESSION['sellerId'];

                                $getImg = "select * from seller where sellerId='$sid'";
                                $resultgetImg = $conn->query($getImg);
                                if($resultgetImg->num_rows > 0){ //over 1 database(record) so run
                                    while($row = $resultgetImg->fetch_assoc()){
                                        // $id=$row['sellerId'];
                                        $sellerName = $row['sellerName'];
                                        $image=$row['image'];              
                                        
                                    echo "<img src=\"../images/profileImage/$image\" alt=\"\"\>";
                                    echo "<span><b>";
                                    echo $sellerName;
                                    echo "</b></span>";
                                    }
                                }
                            }else{
                                echo "<img src=\"../images/man1.jpeg\" alt=\"\"\>";
                                echo "<span>username</span>";
                            }
                        ?>                 
                    </div>       

                    <div class="account-show-box" id="showAccountDetailBox" >
                        <div class="account-box" onclick='window.location("../seller/profile.php")'>
                            <ul>
                                <li class="account-detail">
                                    <a href="./profile.php">
                                        <span><i class="fas fa-user"></i>
                                        Profile</span>
                                    </a>   
                                </li>                                                            
                                <li class="account-detail">
                                <button type="submit" class="logoutBtn" onclick="openModalLogout();">
                                        <i class="fa fas fa-door-open"></i>
                                        Logout
                                </button>
                                </li>
                            </ul>
                        </div>
                    </div>                        
                </div>
                
                <a href="javascript:void(0);" style="font-size:25px;color:black;padding-right:15px;text-decoration:none;" class="icon" onclick="ToggleBtn()">&#9776;</a>
            </div>
    </div>     


    <!-- for logout modal -->
    <div id="logoutModal" class="logout-modal">
        <!-- Modal content -->
        <div class="logout-modal-content">
            <span class="logout-close" data-dismiss="modal">&times;</span>
            <p>Are you sure you want to delete this item?</p>
                        
            <div class="logout-modal-footer">
                <!-- <div class="confirm-box"> -->
                <button type="button" id="confirmLogout">Logout</button>
                <button type="button" id="cancelLogout">Cancel</button>
                <!-- </div> -->
            </div>
        </div>
    </div>


                