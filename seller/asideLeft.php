        <aside class="leftbar">
            <div class="sidebar">
                <a href="./sellerhome.php" title="DashBoard"><i class="fa fa-fw fa-home"></i><span id="task">DashBoard</span> </a>
                <a href="./profile.php"><i class="fa fa-fw fa-wrench"></i> <span id="task">Profile</span></a>

                <!-- product -->
                <a href="#clients" class="dropBtn" id="sidedropdown">
                    <i class="fa fas fa-warehouse"></i> 
                    <span id="changeaction">
                        Product 
                        <i class='fas fa-angle-left iconshow' id="left" style='font-size:20px;padding-left:50px'></i>
                        <!-- <i class='fas fa-angle-down iconhide' id="down" style='font-size:20px;padding-left:50px'></i> -->
                    </span>
                </a>
                <div id="sidebardropdown" class="sidebar-dropdown-content">
                    <a href="./createProduct.php"><i class='fas fa-angle-right icondistance'></i>Create Product</a>
                    <a href="./createAuction.php"><i class='fas fa-angle-right icondistance'></i>Create Auction</a>
                    <a href="./viewProduct.php"><i class='fas fa-angle-right icondistance'></i>Product</a>
                    <a href="./viewAllAuction.php"><i class='fas fa-angle-right icondistance'></i>Auction Product</a>
                </div> 

                 <!-- order -->
                <a href="#clients" class="dropBtn" id="sidedropdown">
                    <i class="fa fa-shopping-cart"></i> 
                    <span id="changeaction">
                        Order 
                        <i class='fas fa-angle-left iconshow' id="left" style='font-size:20px;padding-left:63px'></i>
                        <!-- <i class='fas fa-angle-down iconhide' id="down" style='font-size:20px;padding-left:50px'></i> -->
                    </span>
                </a>
                <div id="sidebardropdown" class="sidebar-dropdown-content">
                    <a href="#home"><i class='fas fa-angle-right icondistance'></i>Create Product</a>
                    <a href="./orderList.php"><i class='fas fa-angle-right icondistance'></i>View Order List</a>
                    <a href="#contact"><i class='fas fa-angle-right icondistance'></i>Return & Refund</a>
                </div> 
                
                <a href="#services"><i class="fa fas fa-comments"></i> <span id="task">Chat</span></a>
                <button type="submit" class="side-button" onclick="openModalLogout();"><i class="fa fas fa-door-open"></i> <span id="task">Log Out</span></button>
                <!-- <div class="showmore">
                    <a href="javascript:void(0);" onclick="opensidebar()"><i style='font-size:15px' class='fas'>&#xf105;</i></a>
                </div> -->
            </div>
        </aside>

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