<?php
session_start();
//Expire the session if user is inactive for 30
//minutes or more.
// $expireAfter = 1;
 
//Check to see if our "last action" session
//variable has been set.

if(isset($_SESSION['m_last_action'])){
    
    //Figure out how many seconds have passed
    //since the user was last active.
    $secondsInactive = time() - $_SESSION['m_last_action'];
    
    //Convert our minutes into seconds.
    $expireAfterSeconds = 5; //5 Seconds
    
    //Check to see if they have been inactive for too long.
    if($secondsInactive >= $expireAfterSeconds){
        //User has been inactive for too long.
        //Kill their session.
        unset($_SESSION['m']);
    }
    
}