<?php
require_once 'Paypal.php';
session_start();

    try {
        $response = $gateway->purchase(array(
            'amount' => $_SESSION['Total'], //get form post page input value
            'currency' => PAYPAL_CURRENCY, //get from config.php
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL,
        ))->send();
 
        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
