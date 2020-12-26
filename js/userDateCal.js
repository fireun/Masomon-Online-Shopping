  /**auction product count down  */

  // Set the date we're counting down to
  var countDownDate = new Date("September 10, 2020 00:00:00").getTime();
  // var time = document.getElementById('duedatecal').value;
  // var countDownDate = new Date(time).getTime();


  // Update the count down every 1 second
  var x = setInterval(function() {
  
    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Output the result in an element with id="demo" days hours miniustes seconds
    document.getElementById("demo").innerHTML = days ;
    document.getElementById("demo1").innerHTML = hours ;
    document.getElementById("demo2").innerHTML = minutes ;
    document.getElementById("demo3").innerHTML = seconds ;
  
    // var auctionD = document.getElementsByClassName('auction-set-D');
    // var auctionH = document.getElementsByClassName('auction-set-H');
    // var auctionM = document.getElementsByClassName('auction-set-M');
    // var auctionS = document.getElementsByClassName('auction-set-S');

    // for (var i = 0; i < auctionD.length; ++i) {
    //     var auctionD = auctionD[i];  
    //     auctionD.innerHTML = days + "d ";
    //     auctionH.innerHTML = hours + "h";
    //     auctionM.innerHTML = minutes = "m";
    //     auctionS.innerHTML = seconds = "s";
    // }

    // document.getElementById("DaysId").innerHTML = days + "d ";
    // document.getElementById("HoursId").innerHTML = hours + "h ";
    // document.getElementById("MinutesId").innerHTML = minutes + "m ";
    // document.getElementById("SecondsId").innerHTML = seconds + "s ";
  
  
    // document.getElementsByClassName("auction-set-count-time").innerHTML = days + "d ";
    // document.getElementsByClassName("auction-set-count-time").innerHTML = hours + "h ";
    // document.getElementsByClassName("auction-set-count-time").innerHTML = minutes + "m ";
    // document.getElementsByClassName("auction-set-count-time").innerHTML = seconds + "s ";
  
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
      document.getElementById("auction").innerHTML = "EXPIRED";
    }
  }, 1000);
  

// var counters = document.getElementsByClassName('view-count-down');
// var countD = document.getElementsByClassName("auction-set-D");
// var countH = document.getElementsByClassName("auction-set-H");
// var countM = document.getElementsByClassName("auction-set-M");
// var countS = document.getElementsByClassName("auction-set-S");
// var endTime = document.getElementsByClassName("duedate");
// var intervals = new Array();

// for (var i = 0, lng = counters.length; i < lng; i++) {
//   (function(i) {
//   	var x = i;
    
//     // Update the count down every 1 second
//     intervals[i] = setInterval(function() {
//       var counterElement = counters[x];
//       var counterElementD = countD[x];
//       var counterElementH = countH[x];
//       var counterElementM = countM[x];
//       var counterElementS = countS[x];
//       var endTimeForEach = endTime[x];
//       // var values = $("input[name='duedate[]']")
//       //         .map(function(){return $(this).val();}).get();
//       // console.log(values);
//       var counterDate = document.getElementById("endtimeID")[x].value();
//       // Set the date we're counting down to
//       var countDownDate = new Date(counterDate);

//       // Get current date and time
//       var now = new Date().getTime();

//       // Find the distance between now an the count down date
//       var distance = countDownDate - now;

//       // Time calculations for days, hours, minutes and seconds
//       var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//       var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//       var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//       var seconds = Math.floor((distance % (1000 * 60)) / 1000);

//       // Display the result in the element with id='demo'
//       // counterElement.innerHTML =   +
//       counterElementD.innerHTML = days + 'd ';
//       counterElementH.innerHTML = hours + 'h ';
//       counterElementM.innerHTML = minutes + 'm ';
//       counterElementS.innerHTML =  seconds + 's';
  
//       // If the count down is finished, write some text
//       if (distance < 0) {
//         clearInterval(intervals[x]);
//         counterElement.style.color = 'red';
//         counterElement.style.fontWeight = '900';
//         counterElement.innerHTML = 'EXPIRED';
//       }
//     }, 1000);
//   })(i);
// }