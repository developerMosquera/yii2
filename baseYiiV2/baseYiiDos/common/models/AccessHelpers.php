<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-23 11:47:16
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-26 17:36:44
 */

namespace common\models;

use yii;

class AccessHelpers {

    public static function getAccess()
    {
        $connection = Yii::$app->db;
        $userAccess = [];
        $userMenu = [];

        $sql = "SELECT operaciones.nomOperacion FROM user LEFT JOIN roles ON user.idRol = roles.idRol LEFT JOIN rolesOperaciones ON roles.idRol = rolesOperaciones.idRol LEFT JOIN operaciones ON rolesOperaciones.idOperacion = operaciones.idOperacion WHERE user.idRol =:idRol";
        $command = $connection->createCommand($sql);
        $command->bindValue(":idRol", Yii::$app->user->identity->idRol);
        $result = $command->queryAll();

        if(!empty($result[0]['nomOperacion']))
        {
            foreach($result as $key => $value)
            {
            	$userAccess[] = $value['nomOperacion'];
            	$modulo = explode("-", $value['nomOperacion']);
                if($modulo[2] == "index")
                {
                    $userMenu[$modulo[0]] = true;
                }
            }

            Yii::$app->session->set('userAccess', $userAccess);
            Yii::$app->session->set('userMenu', $userMenu);

        } else {
            Yii::$app->session->set('userAccess', $userAccess);
            Yii::$app->session->set('userMenu', $userMenu);
        }
    }
}