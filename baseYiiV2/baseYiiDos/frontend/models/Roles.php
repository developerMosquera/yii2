<?php

namespace frontend\models;

use Yii;
use frontend\models\Operaciones;

/**
 * This is the model class for table "roles".
 *
 * @property int $idRol
 * @property string $nomRol
 *
 * @property RolesOperaciones[] $rolesOperaciones
 * @property User[] $users
 */
class Roles extends \yii\db\ActiveRecord
{
    public $operacionesRol;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomRol'], 'required'],
            [['nomRol'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idRol' => Yii::t('app', 'Id Rol'),
            'nomRol' => Yii::t('app', 'Nom Rol'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['idRol' => 'idRol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolesOperaciones()
    {
        return $this->hasMany(RolesOperaciones::className(), ['idRol' => 'idRol']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->db->createCommand()->delete('rolesOperaciones', 'idRol = '.(int) $this->idRol)->execute();

        foreach ($this->operacionesRol as $id)
        {
            $ro = new RolesOperaciones();
            $ro->idRol = $this->idRol;
            $ro->idOperacion = $id;
            $ro->save();
        }
    }

    public function getOperacionesPermitidas()
    {
        return $this->hasMany(Operaciones::className(), ['idOperacion' => 'idOperacion'])
            ->viaTable('rolesOperaciones', ['idRol' => 'idRol']);
    }

    public function getOperacionesPermitidasList()
    {
        return $this->getOperacionesPermitidas()->asArray();
    }
}
