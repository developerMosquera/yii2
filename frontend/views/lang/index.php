<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-09 09:53:16
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-09 14:18:03
 */

use yii\helpers\Html;

echo Html::a('Español', ['change-lang', 'lang' => "es"]);
echo "<br>";
echo Html::a('Inglés', ['change-lang', 'lang' => "en"]);

echo "<br>";
echo "<br>";

$username = "Andres";
echo Yii::t('app', 'hola, {username}', ['username' => $username,]);

echo "<br>";

$age = "27";
echo Yii::t('app', 'Tu edad es: {age}', ['age' => $age,]);

echo "<br>";

$price = 100;
$count = 2;
$subtotal = 200;
echo Yii::t('app', 'Precio: {0}, Cantidad: {1}, Subtotal: {2}', [$price, $count, $subtotal]);

echo "<br>";

$price = 100;
echo Yii::t('app', 'Precio: {0}', $price);

echo "<br>";

$price = 100;
echo Yii::t('app', 'Precio: {0, number, integer}', $price);

echo "<br>";

$cats = 1;
echo Yii::t('app', 'aqui {cats, plural, =0{no hay gatos} =1{hay un gato} other{hay # gatos}}', ['cats' => $cats]);

?>