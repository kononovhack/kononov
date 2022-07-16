<?php

require_once('../config.php');
require_once('./functions.php');

if (!isset($_GET['username']) || empty($_GET['username'])) {
    sendResponse('Укажите имя игрока');
}

if (!isset($_GET['good']) || empty($_GET['good'])) {
    sendResponse('Выберите товар');
}

$currentGood = findGood($config, $_GET['good']);

if ($currentGood == null) {
    sendResponse('Товар не найден');
}

if (isset($currentGood['amounted']) && $currentGood['amounted'] && (!isset($_GET['amount']) || empty($_GET['amount']))) {
    sendResponse('Укажите количество');
}

$price = calculatePrice($_GET['username'], $currentGood, $_GET['amount'], $config);

if ($price == null) {
    sendResponse('Выберите привилегию дороже');
}

sendResponse($price, 'ok');