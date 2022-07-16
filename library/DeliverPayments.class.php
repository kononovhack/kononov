<?php
@session_start();

class Delivery {
    public $cfg;

    public function __construct(){
        require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/library/functions.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/library/rcon.class.php');
        $this->cfg = $config;
    }

    public function unitpay_payment($method, $params) {
        $goodParams = explode('-', $params['account']);
        if($params['signature'] != $this->getSignature($method, $params)) return $this->payment_replay($params, "Подпись неверная");
        if(count($goodParams) < 2) return $this->payment_replay($params, "Счет не обнаружен");

        $currentGood = findGood($this->cfg, $goodParams[1]);
        if ($currentGood == null) return $this->payment_replay($params, "Товар не обнарушен");

        if (isset($currentGood['amounted']) && $currentGood['amounted'] && !isset($goodParams[2])) return $this->payment_replay($params, "Счет не обнаружен");

        $price = calculatePrice($goodParams[0], $currentGood, isset($goodParams[2]) ? $goodParams[2] : 0, $this->cfg);

        if ($price != (int)$params['orderSum'] || $params['orderCurrency'] != 'RUB') return $this->payment_replay($params, "Неверная цена");

        switch ($method) {
            case 'pay':
                $db = mysqli_connect($this->cfg['db']['host'], $this->cfg['db']['user'], $this->cfg['db']['password'], $this->cfg['db']['db']) or die('Ошибка подключения к БД, обновите страницу.');
                $stmt = $db->prepare("INSERT INTO `purchases` (`username`, `title`, `amount`, `image`) VALUES (?, ?, ?, ?)");
                $goodCount = (isset($currentGood['amounted']) && $currentGood['amounted']) ? $goodParams[2] : null;
                $stmt->bind_param('ssds',  $goodParams[0], $currentGood['title'], $goodCount, $currentGood['image']);
                $stmt->execute();
                $this->giveDonate($goodParams);
                return $this->payment_replay($params, "Привилегия выдана!", "success");
                break;
            default :
                return $this->payment_replay($params, "Успешно!", "success");
                break;
        }
        return $this->payment_replay($params, "Мамаша не найдена!");
    }

    public function qiwi_payment($order, $amount) {
        $goodParams = explode('-', $order);
        if(count($goodParams) < 2) die();

        $currentGood = findGood($this->cfg, $goodParams[1]);
        if ($currentGood == null) die('2');

        if (isset($currentGood['amounted']) && $currentGood['amounted'] && !isset($goodParams[2])) die();

        if((int) calculatePrice($goodParams[0], $currentGood, isset($goodParams[2]) ? $goodParams[2] : 0, $this->cfg) != $amount) die();

        $db = mysqli_connect($this->cfg['db']['host'], $this->cfg['db']['user'], $this->cfg['db']['password'], $this->cfg['db']['db']) or die('Ошибка подключения к БД, обновите страницу.');
        $stmt = $db->prepare("INSERT INTO `purchases` (`username`, `title`, `amount`, `image`) VALUES (?, ?, ?, ?)");
        $goodCount = (isset($currentGood['amounted']) && $currentGood['amounted']) ? $goodParams[2] : null;
        $stmt->bind_param('ssds',  $goodParams[0], $currentGood['title'], $goodCount, $currentGood['image']);
        $stmt->execute();
        $this->giveDonate($goodParams);
        die('Ok');
    }
	
	public function enot_payment($order, $amount, $sign) {
		$real_sign = md5($this->cfg['enot']['public_key'].':'.$amount.':'.$this->cfg['enot']['secret_key'].':'.$order);

		if($sign != $real_sign) {
			die('Не проверена подпись!');
		}
		
        $goodParams = explode('-', $order);
        if(count($goodParams) < 2) die();

        $currentGood = findGood($this->cfg, $goodParams[1]);
        if ($currentGood == null) die('2');

        if (isset($currentGood['amounted']) && $currentGood['amounted'] && !isset($goodParams[2])) die();

        if((int) calculatePrice($goodParams[0], $currentGood, isset($goodParams[2]) ? $goodParams[2] : 0, $this->cfg) != $amount) die();

        $db = mysqli_connect($this->cfg['db']['host'], $this->cfg['db']['user'], $this->cfg['db']['password'], $this->cfg['db']['db']) or die('Ошибка подключения к БД, обновите страницу.');
        $stmt = $db->prepare("INSERT INTO `purchases` (`username`, `title`, `amount`, `image`) VALUES (?, ?, ?, ?)");
        $goodCount = (isset($currentGood['amounted']) && $currentGood['amounted']) ? $goodParams[2] : null;
        $stmt->bind_param('ssds',  $goodParams[0], $currentGood['title'], $goodCount, $currentGood['image']);
        $stmt->execute();
        $this->giveDonate($goodParams);
        die('Ok');
    }

    public function getSignature($method, array $params) {
        $delimiter = "{up}";
        ksort($params);
        unset($params['sign']);
        unset($params['signature']);
        return hash('sha256', $method.$delimiter.join($delimiter, $params).$delimiter.$this->cfg['unitpay']['key']);
    }

    public function payment_replay($params, $message, $type = "error"){
        if($type == "success")
        {
            return json_encode(
                array(
                    "jsonrpc" => "2.0",
                    "result" => array(
                        "message" => $message
                    ),
                    'id' => $params['projectId']
                )
            );
        }
        else
        {
            return json_encode(
                array(
                    "jsonrpc" => "2.0",
                    "error" => array(
                        "code" => -32000,
                        "message" => $message
                    ),
                    'id' => $params['projectId']
                )
            );
        }
    }

    public function giveDonate($goodParams, $rLength = 0) {
        if ($rLength == 10) {
            return;
        }

        $currentGood = findGood($this->cfg, $goodParams[1]);
        $cmd = str_replace(['%user%', '%group%', '%amount%'], [$goodParams[0], $goodParams[1], isset($goodParams[2]) ? $goodParams[2] : 0], $currentGood['command']);
        $rcon = new Rcon($this->cfg['rcon']['ip'], $this->cfg['rcon']['port'], $this->cfg['rcon']['password'], 10);

        if (@$rcon->connect()) {
            @$rcon->send_command($cmd);
        } else {
            $this->giveDonate($goodParams, $rLength + 1);
        }
    }
}
