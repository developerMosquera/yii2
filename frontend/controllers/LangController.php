<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-09 09:50:52
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-09 10:30:43
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class LangController extends Controller
{
	public function init()
	{
		Yii::$app->language = Yii::$app->session['lang'];
	}

	public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionChangeLang($lang)
    {
    	$session = Yii::$app->session;
    	$session->set('lang', $lang);
    	Yii::$app->language = Yii::$app->session['lang'];
    	return $this->render('index');
    }
}