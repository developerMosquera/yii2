<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SubCategoria".
 *
 * @property int $idSubCategoria
 * @property int $idCategoria
 * @property string $SubCategoria
 * @property int $estadoSubCategoria
 *
 * @property Productos[] $productos
 * @property Categorias $categoria
 */
class SubCategoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SubCategoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCategoria', 'SubCategoria'], 'required'],
            [['idCategoria', 'estadoSubCategoria'], 'integer'],
            [['SubCategoria'], 'string', 'max' => 30],
            [['idCategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categorias::className(), 'targetAttribute' => ['idCategoria' => 'idCategoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idSubCategoria' => Yii::t('app', 'Id Sub Categoria'),
            'idCategoria' => Yii::t('app', 'Categoria'),
            'SubCategoria' => Yii::t('app', 'Sub Categoria'),
            'estadoSubCategoria' => Yii::t('app', 'Estado Sub Categoria'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['idSubCategoria' => 'idSubCategoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorias::className(), ['idCategoria' => 'idCategoria']);
    }
}
