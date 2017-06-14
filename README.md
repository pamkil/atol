Модуль оплаты yandexmoney-omnipay необходим для интеграции с сервисом [Online.Atol](http://online.atol.ru/) на базе [Omnipay](http://omnipay.thephpleague.com/).

###Требования к Omnipay:
* версия 2.x

###Установка модуля
Установка модуля производится через [Composer](https://getcomposer.org/) запуском команды:
```
composer require pamkil/atol
```
или включением в файл `composer.json` пакета `pamkil/omnipay-atol` с выполнением команды:
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
 ```
$gateway = Omnipay::create('\Omnipay\Atol\Gateway');
$gateway->setLogin([логин]);
$gateway->setPass([пароль]);
$gateway->setInn([ИНН Юр. лица или ИП]);
$gateway->setPaymentAddress([url сайта]);
$gateway->setSno([Применяемая система налогообложения]); 
        //osn – общая СН;
        //usn_income – упрощенная СН (доходы);
        //usn_income_outcome – упрощенная СН (доходы минус расходы);
        //envd – единый налог на вмененный доход;
        //esn – единый сельскохозяйственный налог;
        //patent – патентная СН. 

 ```
5. Отправкой запроса
 ```
    $sell = $gateway->sell();
    $item = new Omnipay\Atol\Message\Item();
    $item
        ->setSum(15)
        ->setTax('none')
        ->setPrice(15)
        ->setQuantity(1)
        ->setTaxSum(0)
        ->setName('Bouquet');
    $sell->setItems([$item]);
    
    $sell->setCallBackUrl('site.ru/v1/acquiring/atoll')
        ->setExternalId(1234213515611)
        //->setInn('7729656202')
        //->setPaymentAddress('test1.atol.ru')
        ->setDatePayment('14.06.2017 15:01:01')
        ->setEmail('sd@df.ru')
        //->setPhone('9123456789') or email or phone
        ->setSno('osn')
        ->setTotalSum(15)
        ->setTypeSum(1);
    $responseSell = $sell->send();
 ```
6. Обработкой ответа 
```
if ($response->isSuccessful()) {
    print_r($response->getData());
    $uuid = $responseSell->getUuid();
} else {
    echo $response->getMessage();
}
```