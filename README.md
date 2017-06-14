Модуль оплаты yandexmoney-omnipay необходим для интеграции с сервисом [Online.Atol](http://online.atol.ru/) на базе [Omnipay](http://omnipay.thephpleague.com/).

###Требования к Omnipay:
* версия 2.x

###Установка модуля
Установка модуля производится через [Composer](https://getcomposer.org/) запуском команды:
```
composer require pamkil/atol
```
или включением в файл `composer.json` пакета `pamkil/atol` с выполнением команды:
```
composer update
```
###Использование
Использование платежного модуля можно разделить на несколько последовательных шагов:

1. Автозагрузка необходимых классов
 ```
require_once (__DIR__.'/vendor/autoload.php');
 ```

2. Использование класса Omnipay/Omnipay
 ```
use Omnipay\Omnipay;
 ```
3. Настройкой модуля для выставления электронных чеков:
 * на кошелек Яндекс.Деньги:
 ```
$gateway = Omnipay::create('\pamkil\Atolll\GatewayIndividual');
$gateway->setAccount([номер_кошелька]);
$gateway->setLabel([номер_заказа]);
$gateway->setPassword([секретное_слово]);
$gateway->setOrderId([номер_заказа]);
$gateway->setMethod([тип_оплаты_PC_или_AC]);
$gateway->setReturnUrl([адрес_страницы_успеха]);
$gateway->setCancelUrl([адрес_страницы_отказа]);
 ```
5. Отправкой запроса
 ```
$response = $gateway->purchase(['amount' => '1.00', 'currency' => 'RUB', 'testMode' => true, 'FormComment'=>'test'])->send();
 ```
6. Обработкой ответа 
```
if ($response->isSuccessful()) {
    print_r($response);
} elseif ($response->isRedirect()) {
    $response->redirect();
} else {
    echo $response->getMessage();
}
```