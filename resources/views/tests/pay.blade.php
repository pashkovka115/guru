<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
function getFormSignature($account, $currency, $desc, $sum, $secretKey) {
    $hashStr = $account.'{up}'.$currency.'{up}'.$desc.'{up}'.$sum.'{up}'.$secretKey;
    return hash('sha256', $hashStr);
}
?>
<body>

<div style="margin-bottom: 20px; margin-top: 20px;">
    <a class="btn btn-large btn-primary"
       href="https://unitpay.ru/pay/349301-48c77?
       account=demo&amp;
       desc=Пробный платеж&amp;
       sum=1&amp;
       currency=RUB&amp;
       signature=57ca16c172353b124c48c83bd79a03bac5f313cc4da158abee9d183f097ba4a2&amp;
       customerEmail=radchenko.yakov@gmail.com"
       target="_blank">Оплатить 1 RUB</a>
</div>

<form action="https://unitpay.ru/pay/349301-48c77/card">
    <input type="text" name="account" value="demo">
    <input type="text" name="sum" value="10">
    <input type="text" name="currency" value="RUB">
    <input type="hidden" name="desc" value="Описание платежа">

    <input type="hidden" name="customerEmail" value="radchenko.yakov@gmail.com">

    <input type="hidden" name="signature" value="<?php echo getFormSignature('demo', 'RUB', 'Описание платежа', 10, '9248e10993f38b06cd8d1fa655eed307'); ?>">

    <input class="btn" type="submit" value="Оплатить">
</form>



{{--<p>
    Образуется как sha256( account + "{up}" + currency + "{up}" + desc + "{up}" + sum + "{up}" + secretKey),
    где sha256 - метод хеширования;
    "{up}" - разделитель параметров в хеш-функции;
    secretKey - секретный ключ проекта (доступен в личном кабинете);
</p>--}}





</body>
</html>