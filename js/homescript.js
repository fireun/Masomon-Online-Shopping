function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
    // document.getElementById("flipkart-navbar").style.width = "50%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0)";
}

$(document).ready(function(){
  $("#showAccountDetailBox").hide();
   
     $("#showAccountBox").mouseenter(function(){
       $("#showAccountDetailBox").show();
     });

     $("#showAccountBox").mouseleave(function(){
       setTimeout(function(){$("#showAccountDetailBox").hide();},1200);/*2 secound hidden */
      
    });
}); 

$(document).ready(function(){
    $("#shoppingbagdetail").hide();
     
       $("#shoppingbag").mouseenter(function(){
         $("#shoppingbagdetail").show();
       });
  
       $("#shoppingbag").mouseleave(function(){
         setTimeout(function(){$("#shoppingbagdetail").hide();},1200);/*2 secound hidden */
        
      });
  }); 




/**modal box */
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("ad-modal-close")[0];

// When the user clicks on the button, open the modal
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

/**auction product silder */
/*default的时候*/
// var slideIndex = 1;
// showSlides(slideIndex);

// /*n=1/n=1-+1=0*/
// function plusSlides(n) {
//   showSlides(slideIndex += n);
// }

// function currentSlide(n) {
//   showSlides(slideIndex = n);
// }

// /*按左右后跳来这个function*/
// function showSlides(n) {
//   var i;
//   var slides = document.getElementsByClassName("auction-slides");
//   // var prevbtn = document.getElementsByClassName("auction-prev-btn");
//   // var nextbtn = document.getElementsByClassName("auction-next-btn");
//   // var dots = document.getElementsByClassName("dot");
//   if (n > slides.length) {
//     slideIndex = 1
//   }
  
//   /*有很多slide的时候收起*/
//   if (n < 1) {
//   	slideIndex = slides.length
//   }
//   for (i = 0; i < slides.length; i++) {
//       slides[i].style.display = "none";  
//   }

//   // if(slideIndex === 1 ){
//   //   prevbtn.style.display = "none";
//   //   nextbtn.style.display = "block";

//   // }else if(slideIndex === 2){
//   //   prevbtn.style.display = "block";
//   //   nextbtn.style.display = "none";
//   // }
  
//   // for (i = 0; i < dots.length; i++) {
//   //     dots[i].className = dots[i].className.replace(" active", "");
//   // }
//   slides[slideIndex-1].style.display = "block";  
//   // dots[slideIndex-1].className += " active";
// }


// scroll back to top js
//Get the button:

backbtn = document.getElementById("backToTop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    backbtn.style.display = "block";
  } else {
    backbtn.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}


//carousel slide home page


// const carouselSlide = document.querySelector('.carousel-slide-home');
// const carouselImage = document.querySelector('.carousel-slide-home img');

// //button
// const prevBtn = document.querySelector('#prevBtn');
// const nextBtn = document.querySelector('#nextBtn');

// //Counter
// let counter = 1;
// const size = carouselImage[0].clientWidth;

// carouselSlide.style.transform = 'translateX(' + (-size * counter ) + 'px)';

// //Button listeners
// nextBtn.addEventListener('click',()=>{
//   carouselSlide.style.transition = "transform 0.4s ease-in-out";
//   counter++;
//   console.log(counter);
//   // carouselSlide.style.transform = carouselSlide.style.transform = 'translateX(' + (-size * counter ) + 'px)';
// });


// tooltip
 $('[data-toggle="tooltip"]').tooltip();