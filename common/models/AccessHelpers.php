<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-12 14:44:54
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-12 15:46:21
 */

namespace common\models;

use yii;


class AccessHelpers {

    public static function getAcceso($operacion)
    {
        $connection = \Yii::$app->db;
        $sql = "SELECT operacion.nombre
                FROM user
                JOIN rol ON user.rol_id = rol.id
                JOIN rol_operacion ON rol.id = rol_operacion.rol_id
                JOIN operacion ON rol_operacion.operacion_id = operacion.id
                WHERE operacion.nombre =:operacion
                AND user.rol_id =:rol_id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":operacion", $operacion);
        $command->bindValue(":rol_id", Yii::$app->user->identity->rol_id);
        $result = $command->queryOne();

        //echo $sql ." - ". $operacion ." - ". Yii::$app->user->identity->rol_id;

        if ($result['nombre'] != null){
            return true;
        } else {
            return false;
        }
    }

}
?>