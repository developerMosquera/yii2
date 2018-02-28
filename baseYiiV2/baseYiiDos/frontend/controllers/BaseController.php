<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-15 07:32:27
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-27 14:29:22
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller {

    public function beforeAction($action)
    {
        if(!parent::beforeAction($action))
        {
            return false;
        }

        $operacion = str_replace("/", "-", Yii::$app->controller->route);

        $modulo = explode('-', $operacion);

        if(isset($modulo[2]))
        {
            if($modulo[2] == "index")
            {
                $operacionPadre = $modulo[0] ."-". $modulo[1] ."-". $modulo[2];
            } else {
                $operacionPadre = $modulo[0] ."-". $modulo[1] ."-index";
            }
        } else {
            $operacionPadre = $operacion;
        }

        $permitirSiempre = ['site-index', 'site-login', 'users-users-confirm', 'prueba-prueba-index', 'prueba-prueba-create', 'prueba-prueba-update', 'prueba-prueba-delete'];

        if(in_array($operacion, $permitirSiempre))
        {
            return true;
        }

        if(in_array($operacionPadre, Yii::$app->session['userAccess']))
        {
            if(in_array($operacion, Yii::$app->session['userAccess']))
            {
                return true;
            } else {
                return $this->redirect(["/site/access-denied"]);
            }

        } else {
            return $this->redirect(["/site/access-denied"]);
        }
    }
}
?>