<?php
require_once "../../vendor/autoload.php";
 
use Omnipay\Omnipay;
 
define('CLIENT_ID', 'Aecp7f7kShTawQKjKJM_44-3HEZPxWz4e_mb4VdwmPc6QHNkJbSOkpjpS-o-2B8Y_F7gm1YLD7wHIrXq');
define('CLIENT_SECRET', 'ED-61-zPi_BLOFQBRtR4rFt2gp6VK21LJaNHryxqE0AJ2rptA8VED_e1enozVo4Ouk_N9eQi7NHSG5Rt');
 
define('PAYPAL_RETURN_URL', 'http://localhost/testProject/database/PayPal/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/testProject/user/purchasePage.php');
define('PAYPAL_CURRENCY', 'MYR'); // set your currency here
 
 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live