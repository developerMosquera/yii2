<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Categorias".
 *
 * @property int $idCategoria
 * @property string $Categoria
 * @property int $estadoCategoria
 *
 * @property SubCategoria[] $subCategorias
 */
class Categorias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Categorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Categoria'], 'required'],
            [['estadoCategoria'], 'integer'],
            [['Categoria'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCategoria' => Yii::t('app', 'Id Categoria'),
            'Categoria' => Yii::t('app', 'Categoria'),
            'estadoCategoria' => Yii::t('app', 'Estado Categoria'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategorias()
    {
        return $this->hasMany(SubCategoria::className(), ['idCategoria' => 'idCategoria']);
    }
}
