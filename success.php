<?php
//For more information please refer to https://github.com/checkout/checkout-sdk-php

use Checkout\CheckoutApiException;
use Checkout\CheckoutAuthorizationException;
use Checkout\CheckoutSdk;
use Checkout\Environment;
use Checkout\OAuthScope;

require __DIR__ . '/vendor/autoload.php';

$paymentID = $_GET['cko-payment-id'];
//API Keys
$api = CheckoutSdk::builder()->staticKeys()
    ->environment(Environment::sandbox())
    ->secretKey("sk_sbox_avozlgdunxxq75h5uduhjvhgaaz")
    ->build();

//OAuth
$api = CheckoutSdk::builder()->oAuth()
    ->clientCredentials("ack_553j5b3b6qhefalg7u42oppk4a", "9pyzUm8x4pLFdp_lrO-C_zek09fbcFCpGwiEc7DAL5up8BcP1obfV11UxUBTo14sH3AwcU_mbXF9uoPgNwmVPw")
    ->scopes([OAuthScope::$Gateway])
    ->environment(Environment::sandbox())
    ->build();

try {
    $response = $api->getPaymentsClient()->getPaymentDetails($paymentID);
    print_r($response);
} catch (CheckoutApiException $e) {
    // API error
    $error_details = $e->error_details;
    $http_status_code = isset($e->http_metadata) ? $e->http_metadata->getStatusCode() : null;
} catch (CheckoutAuthorizationException $e) {
    // Bad Invalid authorization
}

//localhost/testcheckout/success.php?cko-payment-id=pay_fthqvkc72wle3hq4tnjduvmuce