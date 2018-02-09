<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\SubCategoria;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Productos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'clientOptions' => [
            'dom' => 'lfrtipB',
            'buttons' => ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
             "dom"=> 'lfTrtip',
            'language' => [
                "lengthMenu" => Yii::t('app', 'showing') . " _MENU_ " . Yii::t('app', 'rows_per_page'),
                "zeroRecords" => Yii::t('app', 'no_records_found'),
                "info" => Yii::t('app', 'showing') . " _PAGE_ " . Yii::t('app', 'of') . " _PAGES_",
                "infoEmpty" => Yii::t('app', 'no_records_available'),
                "infoFiltered" => "(" . Yii::t('app', 'filtering_for') . ")",
                "search" => Yii::t('app', 'search') . " :",
                "paginate" => [
                    "first" => Yii::t('app', 'first'),
                    "last" => Yii::t('app', 'last'),
                    "next" => Yii::t('app', 'next'),
                    "previous" => Yii::t('app', 'previous')
                ],
            ],
        ],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idProducto',
            ['attribute' => 'idSubCategoria',
                'value' => function($model){
                    $subCategoria = SubCategoria::findOne($model->idSubCategoria);
                    return $subCategoria->SubCategoria;
                },
                'filter' => ArrayHelper::map(SubCategoria::find()->all(), 'idSubCategoria', 'SubCategoria'),
            ],
            'nomProducto',
            ['attribute' => 'estadoProducto',
                'value' => function($model){
                    return($model->estadoProducto == 1) ? Yii::t('app', 'Activo') : Yii::t('app', 'Inactivo');
                },
                'filter' => array("1" => "Activo", "0" => "Inactivo"),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
