<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-13 08:35:05
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-13 08:40:06
 */

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\AccessHelpers;

class BaseController extends Controller {

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
        {
            return false;
        }
        $operacion = str_replace("/", "-", Yii::$app->controller->route);

        $permitirSiempre = ['site-captcha', 'site-signup', 'site-index', 'site-error', 'site-about', 'site-login', 'site-logout'];

        if (in_array($operacion, $permitirSiempre))
        {
            return true;
        }

        if (!AccessHelpers::getAcceso($operacion))
        {
            echo $this->render('/site/nopermitido');
            return false;
        }

        return true;
    }
}
?>