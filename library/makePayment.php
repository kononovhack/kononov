<?php
@session_start();

require_once('../config.php');
require_once('./functions.php');

if (!isset($_GET['username']) || empty($_GET['username'])) {
    echo 'Укажите имя игрока';
    die;
}

if (!isset($_GET['good']) || empty($_GET['good'])) {
    echo 'Выберите товар';
    die;
}

$currentGood = findGood($config, $_GET['good']);

if ($currentGood == null) {
    echo 'Товар не найден';
    die;
}

if (isset($currentGood['amounted']) && $currentGood['amounted'] && (!isset($_GET['amount']) || empty($_GET['amount']))) {
    echo 'Укажите количество';
    die;
}

$price = calculatePrice($_GET['username'], $currentGood, $_GET['amount'], $config);

if ($price == null) {
    sendResponse('Выберите привилегию дороже');
}

if (!isset($currentGood['amounted'])) {
    $currentGood['amounted'] = false;
}

$payNum = $currentGood['amounted'] ? "{$_GET['username']}-{$_GET['good']}-{$_GET['amount']}" : "{$_GET['username']}-{$_GET['good']}";
$desc = "Покупка игровой привилегии на сайте {$config['site_name']}";

$sign = getFormSignature($payNum, $desc, $price, $config['unitpay']['key']);
$sign_enot = md5($config['enot']['public_key'].':'.$price.':'.$config['enot']['secret_key'].':'.$payNum);

$_SESSION['unitpay_link'] = "https://unitpay.money/pay/{$config['unitpay']['project_id']}/webmoney?sum={$price}&account={$payNum}&desc={$desc}&signature={$sign}";
$_SESSION['qiwi_link'] = "https://oplata.qiwi.com/create?publicKey={$config['qiwi']['public_key']}&amount={$price}&account={$payNum}&comment={$desc}&successUrl=https://ragemine.ru/";
$_SESSION['enot_link'] = "https://enot.io/_/pay?m={$config['enot']['public_key']}&oa={$price}&o={$payNum}&s={$sign_enot}";

header('Location: /select.php');
//header( "Location: https://unitpay.ru/pay/{$config['unitpay']['project_id']}?sum={$price}&account={$payNum}&desc={$desc}");