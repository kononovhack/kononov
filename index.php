<?php
require_once('./config.php');
$db = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['db']) or die('Ошибка подключения к БД, обновите страницу.');

$lastPurchases = mysqli_query($db, "SELECT * FROM `purchases` ORDER BY id DESC LIMIT 5");
?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <title><?= $config['site_name'] ?> - Покупка доната, привилегий, ключей, кейсов</title>
        <meta name="description"
              content="<?= $config['description'] ?>">
        <meta name="keywords" content="<?= $config['description'] ?>">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700&display=swap&subset=cyrillic"
              rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
              rel="stylesheet">
        <link href="assets/style.css" rel="stylesheet">
    </head>

    <body>

    <div class="header">
        <div class="container">
            <div class="navbar">
                <a href="#" rel="nofollow" class="navbar-mobile"><i class="fa fa-bars"></i></a>
                <div class="navbar-wrapper">
                    <div class="block-left">
                        <a href="/" class="logo" rel="nofollow">
                            <div class="block-left">
                                <div class="logo-lt">R</div>
                                <div class="logo-rb">M</div>
                            </div>
                            <div class="block-right">
                                <span class="col-deep-purple">R</span>age<span class="col-black">M</span>ine
                            </div>
                        </a>
                    </div>

                    <div class="block-center"></div>

                    <div class="block-right">
                        <ul>
                            <li class="active"><a href="/" rel="nofollow"><i class="fa fa-shopping-basket"></i> Главная</a>
                            </li>

                            <li><a href="#" data-modal="help" rel="nofollow"><i class="fa fa-file-text"></i> Пользовательское соглашение</a></li>

                            <li><a href="https://vk.com/ragemine_ru" target="_blank" rel="nofollow"><i
                                            class="fa fa-vk"></i> Группа ВК</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="tabs">
            <div class="tabs-wrapper">
                <div class="block-left">
                    <ul class="tab-links">
                        <?php
                        foreach ($config["categories"] as $key => $value):
                            ?>
                            <li class="<?= ($value['default'] ? 'active' : '') ?>" data-id="<?= $key ?>">
                                <a href="#" rel="nofollow">
                                    <span class="block-left"><i class="fa fa-diamond"></i></span>
                                    <span class="block-right"><?= $value['title'] ?></span>
                                </a>
                            </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>

                <div class="block-right">
                    <button class="btn block copy-clipboard text-upper text-bold"
                            data-clipboard-text="<?= $config['server_ip'] ?>">
                        <?= $config['server_ip'] ?>
                    </button>
                </div>
            </div>
            <div class="tab-list">
                <?php foreach ($config["categories"] as $key => $value): ?>
                    <div class="tab-id <?= ((isset($value['default']) && $value['default']) ? "active" : "") ?>"
                         data-id="<?= $key ?>">
                        <?php if (isset($value['notify'])): ?>
                            <div class="category-text pb-20">
                                <div class="panel"><?= $value['notify'] ?></div>
                            </div>
                        <?php endif; ?>
                        <div class="items">
                            <?php foreach ($value['products'] as $k => $v): ?>
                                <div class="item-id" data-modal="paymodal"
                                     data-amounted="<?= ((isset($v['amounted']) && $v['amounted']) ? "1" : "") ?>"
                                     data-name="<?= $k ?>" data-price="<?= $v['price'] ?>"
                                     data-withSurcharge="<?= ((isset($v['withSurcharge']) && $v['withSurcharge']) ? "1" : "") ?>">
                                    <div class="image" style="background-image: url('<?= $v['image'] ?>');"></div>
                                    <div class="title"><?= $v['title'] ?></div>
                                    <div class="price"><?= $v['price'] ?> <i class="fa fa-ruble col-black"></i></div>
                                    <?php if (isset($v['discount']) && $v['discount'] > 0): ?>
                                        <div class="discount">-<?= $v['discount'] ?>%</div><?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="payments">
            <div class="blockname">Последние покупки</div>
            <div class="payment-list">
                <?php if ($lastPurchases):
                    while($lastPurchase = $lastPurchases->fetch_assoc()):
                ?>
                <div class="payment-id window item-id" style="display: block;">
                    <div class="image" style="background-image: url(<?=$lastPurchase['image']?>);"></div>
                    <div class="title"><?=$lastPurchase['title']?></div>
                    <div class="player">─ <?=$lastPurchase['username']?></div>
                    <?php if (isset($lastPurchase['amount']) && $lastPurchase['amount'] > 1): echo "<div class='amount'>x{$lastPurchase['amount']}</div>"; endif ?>
                </div>
                <?php
                    endwhile;
                    else:
                ?>
                <p>Нет последних покупок</p>
                <?php endif; ?>
        </div>
    </div>

    <div class="modal" data-id="paymodal">
        <div class="wrapper">
            <form id="buyform" method="get" action="library/makePayment.php" class="modal-content">
                <div class="modal-header text-center text-bold"></div>

                <input type="hidden" name="price" id="price" value="">
                <input type="hidden" name="good" id="good" value="">

                <div class="modal-body">
                    <div class="input-block">
                        <label for="login">Укажите Ваш никнейм на сервере</label>
                        <input type="text" name="username" id="login" placeholder="ВВЕДИТЕ НИКНЕЙМ">
                    </div>
                    <div id="amounted">
                        <br>
                        <div class="input-block">
                            <label for="amount">Укажите кол-во товара</label>
                            <input id="amount" type="number" min="1" step="1" name="amount" id="amount" value="1"
                                   placeholder="ВВЕДИТЕ КОЛ-ВО">
                        </div>
                    </div>
                </div>

                <div class="modal-footer text-right">
                    <button class="btn text-upper" id="submitBtn" type="submit">Оплатить</button>
                    <button data-modal-close class="btn text-upper btn-clear">Закрыть</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="block-left">
                <a href="/" class="logo" rel="nofollow">
                    <div class="block-left">
                        <div class="logo-lt">R</div>
                        <div class="logo-rb">M</div>
                    </div>
                    <div class="block-right">
                        <span class="col-deep-purple">R</span>age<span class="col-black">M</span>ine
                    </div>
                </a>
            </div>

            <div class="block-center">
                Полное или частичное копирование сайта запрещено © <?= $config['site_name'] ?>
            </div>
            <div class="block-center">
                <p>Почта для связи: help@ragemine.ru</p>Телеграмм для связи: @ragemine</p>ВКонтакте для связи: vk.com/darkakyloff
            </div>
        </div>
    </footer>

    <div class="modal" data-id="donate">
        <div class="wrapper">
            <div class="modal-content">
                <div class="modal-header text-center text-bold">Описание доната</div>

                <div class="modal-body">

                    <center>
                        <p><a href="/" rel="nofollow" class="btn btn-success">Приобрести донат</a></p>
                        <br>
                        <p>
                        <h2><font color="blue" face="Arial">Возможности привилегий</font></h2></p>
                        <br>
                        <p>
                        <h1>ВОИН</h1></p>
                        <br>
                        <img src="https://i.imgur.com/YNaINcr.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>ПРИНЦ</h1></p><br>
                        <img src="https://i.imgur.com/ZculW4a.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>РЫЦАРЬ</h1></p><br>
                        <img src="https://i.imgur.com/2xklkIb.jpg" class="img-fluid">
                        <hr>
                        <p>
                        <h1>ЛОРД</h1></p><br>
                        <img src="https://i.imgur.com/mYsv1A0.jpg" class="img-fluid">
                        <hr>
                        <p>
                        <h1>ТРИТОН</h1></p><br>
                        <img src="https://i.imgur.com/sdlDDMs.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>ЗЕВС</h1></p><br>
                        <img src="https://i.imgur.com/OxAAnG4.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>ЭПИК</h1></p><br>
                        <img src="https://i.imgur.com/2cx1pdP.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>DRAGON</h1></p><br>
                        <img src="https://i.imgur.com/pENDYnj.png" class="img-fluid">
                        <hr>
                        <p>
                        <h1>Донат кейс</h1></p><br>
                   <center>
						<br>
						<p>В кейс с Донатом входит ВОИН, ПРИНЦ, РЫЦАРЬ, ЛОРД, ТРИТОН, ЗЕВС, ЭПИК, ДРАГОН.</p><br>
                        </center>
                        <h1>Кейс с франками</h1></p><br>
                   <center>
						<br>
						<p>В кейс с Франками входит 250 франков, 500 франков, 1000 франков, 3000 франков, 6000 франков,
						8000 франков, 16000 франков, 25000 франков.</p><br>
                        </center>
                        <h1>Кейс с Аниме титулами</h1></p><br>
                   <center>
						<br>
						<p>В кейс с Аниме титулами входят титулы Кун, Братик, Ня, Семпай, Наруто, Гаара, Киллер Би, Хашимара, Оноки, Майто, Рок Ли, Обито, Шинки, Сай Таюя, Гурен, Саске.</p><br>
                        </center>
                        <h1>Кейс с Новогодними титулами</h1></p><br>
                   <center>
						<br>
						<p>В кейс с Новогодними титулами входят титулы Снеговик, Лядышка, Ёлка, Снег, #2021, Оливье, Чудесный, Санта, Дед-мороз, Новый год, Украшение, Кока-Кола, Закат, Чудо, Загадочный, Подарок, Снежное чудо.</p><br>
                        </center>
                        <h1>Кейс с Приватными титулами</h1></p><br>
                   <center>
						<br>
						<p>В кейс с Приватными титулами входят титулы Mag, Ez, Pvp, :3, LikesCombo, <3, Able, Power, Force, Speed, Cube, Donate, Supreme, Emperor, Killer, Pro, Fire..</p><br>
                        </center>
                        <h1>Кейс с Титулами Рик и Морти</h1></p><br>
                   <center>
						<br>
						<p>В кейс с Титулами Рик и Морти титулами входят титулы Кроненбер, Юнити, Шептун, Морти, Токсик, Джерри, Плюмбус, Швифт, Мисикс, Земля, Бет, Саммер, Рик, Ягуар, Наука, Джессика, Портал.</p><br>
                        </center>
                        <h1>Возникли проблемы?</h1></p><br>
                        <p>Ты всегда можешь обратиться в нашу службу поддержки!</p><br>
                        <p><a rel="nofollow" target="_blank" href="https://vk.com/agemine_ru" class="btn btn-warning">Обратиться
                                в техническую поддержку</a></p>
                    </center>

                </div>

                <div class="modal-footer text-right">
                    <button data-modal-close class="btn btn-clear text-upper">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" data-id="help">
        <div class="wrapper">
            <div class="modal-content">
                <div class="modal-header text-center text-bold">Пользовательское Соглашение</div>

                <div class="modal-body">

                   <center>					
                        <p>1.1 Деньги после покупки любого товара или услуги не возвращаются ни в каком размере.<br>
						<br>
						
<p>1.2 При взломе, несанкционнированном доступе, утери данных в следствии стихийных бедствий, пожаров, технических неполадок, аварий в дата центре и т.д, гарантии возврата доната не предоставляется.<br>
<br>
<p>1.3 При попытке обмануть администрацию сервера: предоставить фейковый скриншот оплаты, другой ник и т.д, или же оскорбить администрацию, даже при действительной покупке привилегии, администратор в выдаче привилегии способен отказать.<br>
<br>
<p>1.4 Если вы нарушали правила сервера, то администратор сервера в праве снять с вас донат и не вернуть деньги за покупку доната.</p><br>
                    </center>

                </div>

                <div class="modal-footer text-right">
                    <button data-modal-close class="btn btn-clear text-upper">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script src="/assets/script.js"></script>

    </body>
    </html>

<?php
