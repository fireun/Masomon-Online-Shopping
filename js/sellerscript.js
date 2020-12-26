
// window.onscroll = function() {navbarfunction()};

// var navbar = document.getElementById("navbar");
// var sticky = navbar.offsetTop;

// function navbarfunction() {
//   if (window.pageYOffset >= sticky) {
//     navbar.classList.add("sticky")
//   } else {
//     navbar.classList.remove("sticky");
//   }
// }



/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function ToggleBtn() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }

//   function sidedropdown() {
//     document.getElementById("sidebardropdown").classList.toggle("show");
//   }
  /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropBtn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    
$(document).ready(function(){
  $("#showAccountDetailBox").hide();//default mode
   
    //input icon area - show box
     $("#showAccountBox").mouseenter(function(){
       $("#showAccountDetailBox").show();
     });

     $("#showAccountBox").mouseleave(function(){
       setTimeout(function(){$("#showAccountDetailBox").hide();},3000);/*2 secound hidden */
    });
}); 
  // Close the dropdown menu if the user clicks outside of it
//   window.onclick = function(event) {
//     document.getElementsByClassName("sidebar-dropdown-content").classList.remove("show");
//   }

// $(document).ready(function(){
//     $("#sidebardropdown").click(function(){
//       $("#sidebardropdown").toggleClass("sidebar-dropdown-content");
//     });
//   });

function openModalLogout(){
  var confirmBtn = document.getElementById("confirmLogout");
  var logoutModalBox = document.getElementById("logoutModal");
  var closed = document.getElementsByClassName("logout-close")[0];

        // When the user clicks on the button, open the modal
        // btn.onclick = function() {
        //     modal.style.display = "block";
        // }

        //default
        logoutModalBox.style.display = "block";

        
        // link to logout
        confirmBtn.onclick = function() {
          window.location.assign("./logout.php");
        }
        // When the user clicks on <span> (x), close the modal
        closed.onclick = function() {
            logoutModalBox.style.display = "none";
        }
        
        //cancel button
        var cancelBtn = document.getElementById("cancelLogout");
        cancelBtn.onclick = function() {
          logoutModalBox.style.display ="none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == logoutModalBox) {
            logoutModalBox.style.display = "none";
          }
        }
}


