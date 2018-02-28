<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "operaciones".
 *
 * @property int $idOperacion
 * @property string $nomOperacion
 *
 * @property RolesOperaciones[] $rolesOperaciones
 */
class Operaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomOperacion'], 'required'],
            [['nomOperacion'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOperacion' => Yii::t('app', 'Id Operacion'),
            'nomOperacion' => Yii::t('app', 'Nom Operacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolesOperaciones()
    {
        return $this->hasMany(RolesOperaciones::className(), ['idOperacion' => 'idOperacion']);
    }
}
