<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rolesOperaciones".
 *
 * @property int $idRoleOperacion
 * @property int $idRol
 * @property int $idOperacion
 *
 * @property Roles $rol
 * @property Operaciones $operacion
 */
class RolesOperaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rolesOperaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idRol', 'idOperacion'], 'required'],
            [['idRol', 'idOperacion'], 'integer'],
            [['idRol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['idRol' => 'idRol']],
            [['idOperacion'], 'exist', 'skipOnError' => true, 'targetClass' => Operaciones::className(), 'targetAttribute' => ['idOperacion' => 'idOperacion']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idRoleOperacion' => Yii::t('app', 'Id Role Operacion'),
            'idRol' => Yii::t('app', 'Id Rol'),
            'idOperacion' => Yii::t('app', 'Id Operacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Roles::className(), ['idRol' => 'idRol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperacion()
    {
        return $this->hasOne(Operaciones::className(), ['idOperacion' => 'idOperacion']);
    }
}
