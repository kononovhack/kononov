<?php

$config = [
    "site_name" => "RAGEMINE", // Название сервера
    "description" => "", // Описание
    "keywords" => "", // Ключевые слова для поисковиков
    "server_ip" => "mc.RageMine.ru", // IP сервера
    "db" => [ // Данные для доступа к БД
        "host" => "127.0.0.1",
        "user" => "lp",
        "password" => "F17eDO2O364O16D521ziHAGenaQoCA",
        "db" => "LP",
    ],
    "unitpay" => [ // Конфигурация юнитпея, key - секретный ключ, project_id - публичный ключ
        "project_id" => "425801-144f2",
        "key" => "960ce493ef5f07cd76d5b29ecebaf770",
    ],
    "qiwi" => [
        "site_id" => "",
        "public_key" => "48e7qUxn9T7RyYE1MVZswX1FRSbE6iyCj2gCRwwF3Dnh5XrasNTx3BGPiMsyXQFNKQhvukniQG8RTVhYm3iPyw6xKXmvcZXvVziAYscGfY7hTeynwdBrGKEDpTY2QRjzBsEtzS5bK6x2nuKWZwaRNLMGfqTJ43xd99hX4K5XjkNFzSt8drd2t2dMsL35M",
        "secret_key" => "eyJ2ZXJzaW9uIjoiUDJQIiwiZGF0YSI6eyJwYXlpbl9tZXJjaGFudF9zaXRlX3VpZCI6IndqeW50bS0wMCIsInVzZXJfaWQiOiI3OTA5NTQ5OTQzOSIsInNlY3JldCI6IjJhZDU1MTM0ZmQwNGRmM2ViYmUyYTEzMWJjYjYyNThiZWQ2N2FhZjIxNjdjMDFiNDFjZTJlYzJkYzAwNTlhYzYifX0=",
    ],
	"enot" => [
        "public_key" => "",
        "secret_key" => "",
    ],
     "rcon" => [ // Данные для RCON доступа
        "ip" => "127.0.0.1",
        "port" => "7777",
        "password" => "77ZDv1tJQybJ0MOsAwd5Lsbp"
    ],
    "categories" => [
        "category" => [
            "title" => "Привилегии",
            "default" => true,
            "notify" => "💜⚡ В ЧЕСТЬ ЛЕТА ИДУТ БОЛЬШИЕ СКИДКИ НА ВСЕ ТОВАРЫ 💜⚡",
            "products" => [
                "voin" => [
                    "title" => "ВОИН",
                    "price" => 3,
					"discount" => 15,
                    "image" => "https://i.imgur.com/WEQh2Es.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add voin",
                ],
                "knight" => [
                    "title" => "РЫЦАРЬ",
                    "price" => 5,
					"discount" => 15,
                    "image" => "https://i.imgur.com/kjLgmhD.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add knight",
                ],
                "guard" => [
                    "title" => "СТРАЖ",
                    "price" => 10,
					"discount" => 15,
                    "image" => "https://i.imgur.com/N3WMJeX.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add guard",
                ],
                "legend" => [
                    "title" => "ЛЕГЕНДА",
                    "price" => 20,
					"discount" => 15,
                    "image" => "https://i.imgur.com/lrYZzh9.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add legend",
                ],
                "lord" => [
                    "title" => "ЛОРД",
                    "price" => 35,
					"discount" => 15,
                    "image" => "https://i.imgur.com/xjkvJaO.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add lord",
                ],
                "titan" => [
                    "title" => "ТИТАН",
                    "price" => 50,
					"discount" => 15,
                    "image" => "https://i.imgur.com/aRJKkML.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add titan",
                ],
                "imperator" => [
                    "title" => "ИМПЕРАТОР",
                    "price" => 90,
					"discount" => 15,
                    "image" => "https://i.imgur.com/mqBcE2p.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add imperator",
                ],
                "zeus" => [
                    "title" => "ЗЕВС",
                    "price" => 160,
					"discount" => 15,
                    "image" => "https://i.imgur.com/ZPTnuDS.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add zeus",
				],
                "enigma" => [
                    "title" => "ЭНИГМА",
                    "price" => 240,
					"discount" => 15,
                    "image" => "/cgi-bin/Knight.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add enigma",
				],
                "schalker" => [
                    "title" => "ШАЛКЕР",
                    "price" => 600,
					"discount" => 15,
                    "image" => "/cgi-bin/Warlord.png",
                    "withSurcharge" => true,
                    "command" => "lp user %user% group add schalker",
                ]
            ]
        ],
        "category2" => [
            "title" => "Кейсы",
            "notify" => "💜⚡ В ЧЕСТЬ ЛЕТА ИДУТ БОЛЬШИЕ СКИДКИ НА ВСЕ ТОВАРЫ 💜⚡",
            "products" => [
                "donateshop" => [
                    "title" => "Ключи к кейсу с донатом",
                    "price" => 20,
					"discount" => 25,
                    "image" => "https://i.imgur.com/3q0MLa2.png",
                    "amounted" => true,
                    "command" => "cases give %user% donate %amount%",
                ],
                "money" => [
                    "title" => "Ключи к кейсу с рублями",
                    "price" => 40,
					"discount" => 25,
                    "image" => "https://i.imgur.com/3q0MLa2.png",
                    "amounted" => true,
                    "command" => "cases give %user% rub %amount%",
                ]
            ]
        ],
        "category4" => [
            "title" => "Прочее",
            "notify" => "💜⚡ В ЧЕСТЬ ЛЕТА ИДУТ БОЛЬШИЕ СКИДКИ НА ВСЕ ТОВАРЫ 💜⚡",
            "products" => [
                "unban" => [
                    "title" => "Разбан",
                    "price" => 50,
					"discount" => 20,
                    "image" => "https://i.imgur.com/GuxK0vI.png",
                    "amounted" => false,
                    "command" => "unban %user%",
                ]
            ]
        ]
    ],
    "super_products" => [
        "admin",
        "stmoder",
        "moder",
        "helper",
        "youtube",
    ],
];


/*

    Структура категории:
    'title' - Название
    'default' => true - категория по умолчанию (может быть только у одной категории)
    'notify' - произвольное сообщение, отображается над товарами
    'products' - массив с товарами

    Структура товара:
    'title' - название
    'price' - цена
    'discount' - скидка (можно не указывать)
    'image' - ссылка на картинку товара
    'amounted' => true - можно заказать несколько товаров (необязательное поле)
    'withSurcharge' => true - работает доплата (не работает одновременно с amounted)
    'command' - команда, выполняемая для выдачи услуге. %amount% заменяется на количество, %user% на ник игрока, %good% на название товара


*/
