<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property int $idDepartamento Identificador único del departamento
 * @property string $nomDepartamento Nombre del departamento
 *
 * @property Municipios[] $municipios
 * @property User[] $users
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomDepartamento'], 'required'],
            [['nomDepartamento'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDepartamento' => Yii::t('app', 'Id Departamento'),
            'nomDepartamento' => Yii::t('app', 'Nom Departamento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipios::className(), ['idDepartamento' => 'idDepartamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['idDepartamento' => 'idDepartamento']);
    }
}
