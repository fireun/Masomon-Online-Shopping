<!--Bootstrap CSS-->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->

<!--Boostrap JS-->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->

    <!-- Top Nav Bar -->
    <nav class="navbar  fixed-top navbar-expand-lg navbar-light" style="background-color:#CD5C5C">

        <a class="navbar-link nav-link text-body" href="../user/home.php">Home</a>
        <!-- <img src="../images/user.png" alt="logo" class="navbar-brand" style="width:5%"> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="../user/home.php">Home</a>
                    <a class="nav-link" href="#">Contact Us <span class="sr-only">(current)</span></a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->
            </ul>
            <div class="form-inline my-2 my-lg-0" data-toggle="dropdown" data-hover="dropdown" role="button">
                <h6 class="m-2 username-hover">
                <?php
                     if(isset($_SESSION['username'])){
                        echo $user = $_SESSION['username'];
                     }else{
                         echo "unlogin";
                     }
                ?>
                </h6>
                <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            </div>
            <div class="dropdown-menu dropdown-menu-right mr-4">
                <a href="../user/profile.php" class="account-link dropdown-item">
                    <span>My Account</span>
                </a>
                <form action="../user/home.php" method="post">
                    <button type="submit" name="logout" class="dropdown-item account-link account-link-logout">
                         <span>Logout</span>                                                      
                    </button>
                </form> 
            </div>
        </div>
    </nav><!-- End Top NavBar -->