<?php

define('PaysbuyPayAPI\PUBLIC_KEY', 'pub_test_90b0ca8570f7c2cd0c20');
define('PaysbuyPayAPI\SECRET_KEY', 'priv_test_90b0ca8570f7c2cd0c20');

require_once "vendor/autoload.php";


/* EXTREMELY IMPORTANT **************************************************************************
*                                                                                               *
*  You probably shouldn't be using this on a live server unless your company/organisation       *
*  is PCI compliant! If you need to use our tokenisation service on your site, you should       *
*  almost certainly be using our JS library:                                                    *
*                                                                                               *
*    https://github.com/paysbuy/paysbuy.js                                                      *
*                                                                                               *
*  Using this, all sensitive data will be sent from the client directly to PAYSBUY's secure,    *
*  PCI compliant servers for tokenisation - removing any potential risk of you handling         *
*  sensitive customer payment information (credit card details etc.) on your servers            *
*                                                                                               *
************************************************************************************************/


$token = \PaysbuyPayAPI\Token::create(array(
	'wallet_id' => '0912345678',
	'wallet_brand' => 'WaveMoney',
	// 'card_number' => '4111111111111111',
	// 'card_expiry_month' => '04',
	// 'card_expiry_year' => '2020',
	// 'card_cvn' => '324'
));

echo "\n\n";
var_dump($token->toJSON());
echo "\n\n";

$payment = \PaysbuyPayAPI\Payment::create([
	"token" => $token['object']['token']['id'],
	"amount" => '100.00',
	"currency" => 'THB',
	"invoice" => 'abcdefg',
	"description" => 'test charge'
]);

echo "\n\n";
var_dump($payment->toJSON());
echo "\n\n";

