<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipios".
 *
 * @property int $idMunicipio Identificador único del municipio
 * @property int $idDepartamento Identificador único del departamento 
 * @property string $nomMunicipio Nombre del municipio
 *
 * @property Departamentos $departamento
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDepartamento', 'nomMunicipio'], 'required'],
            [['idDepartamento'], 'integer'],
            [['nomMunicipio'], 'string', 'max' => 50],
            [['idDepartamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['idDepartamento' => 'idDepartamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMunicipio' => Yii::t('app', 'Id Municipio'),
            'idDepartamento' => Yii::t('app', 'Id Departamento'),
            'nomMunicipio' => Yii::t('app', 'Nom Municipio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::className(), ['idDepartamento' => 'idDepartamento']);
    }
}
