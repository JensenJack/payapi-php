<?php

// Put your public and secret keys here

define('PaysbuyPayAPI\PUBLIC_KEY', 'pub_test_xxxxxxxxxxxxxxxxxxxx');
define('PaysbuyPayAPI\SECRET_KEY', 'priv_test_xxxxxxxxxxxxxxxxxxxx');

require_once "vendor/autoload.php";


// This token should be obtained from our client-side JS tokenization library
// which can be found at - https://github.com/paysbuy/paysbuy.js

$tokenId = "xxxxxxxxxxxxxxxxxx"; 

$payment = \PaysbuyPayAPI\Payment::create([
	"token" => $tokenId,
	"amount" => '100.00',
	"currency" => 'THB',
	"invoice" => 'abcdefg',
	"description" => 'test charge'
]);

echo "\n\n";
var_dump($payment->toJSON());
echo "\n\n";

