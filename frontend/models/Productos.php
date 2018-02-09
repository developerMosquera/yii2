<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Productos".
 *
 * @property int $idProducto
 * @property int $idSubCategoria
 * @property string $nomProducto
 * @property int $estadoProducto
 *
 * @property SubCategoria $subCategoria
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idSubCategoria', 'nomProducto'], 'required'],
            [['idSubCategoria', 'estadoProducto'], 'integer'],
            [['nomProducto'], 'string', 'max' => 45],
            [['idSubCategoria'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoria::className(), 'targetAttribute' => ['idSubCategoria' => 'idSubCategoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProducto' => Yii::t('app', 'Id Producto'),
            'idSubCategoria' => Yii::t('app', 'Sub Categoria'),
            'nomProducto' => Yii::t('app', 'Nom Producto'),
            'estadoProducto' => Yii::t('app', 'Estado Producto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoria()
    {
        return $this->hasOne(SubCategoria::className(), ['idSubCategoria' => 'idSubCategoria']);
    }
}
