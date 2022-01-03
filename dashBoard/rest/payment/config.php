<?php

// $keyId = 'rzp_test_z1VlDNunoD01bf';
// $keySecret = 'pPrWfMv0zVL2qlyWryC9QITr';
// $displayCurrency = 'INR';

$keyId = getenv("keyId");
$keySecret = getenv("keySecret");
$displayCurrency = getenv("displayCurrency");

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
