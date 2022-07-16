<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/library/DeliverPayments.class.php';
$Delivery = new Delivery;


//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0){
    echo '<script type="text/javascript">window.location.href="/";</script>';
    die();
}

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content, true);

//If json_decode failed, the JSON is invalid.
if(!is_array($decoded)){
    die();
}

if($decoded['bill']['status']['value'] !== 'PAID') die();
if($decoded['bill']['siteId'] !== $Delivery->cfg['qiwi']['site_id']) die();

$Delivery->qiwi_payment($decoded['bill']['customer']['account'], $decoded['bill']['amount']['value']);

