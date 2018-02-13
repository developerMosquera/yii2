<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-12 14:53:28
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-12 15:40:17
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
    <p>No tiene permiso para acceder a esta página.</p>
    </div>
</div>