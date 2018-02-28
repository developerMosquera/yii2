<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
use yii\helpers\ArrayHelper;
use frontend\models\Roles;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'clientOptions' => Yii::t('app', 'clientOptionsButtons'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'idRole',
                'value' => function($model){
                    return Roles::findOne($model->idRol)->nomRol;
                },
                'filter' => ArrayHelper::map(Roles::find()->all(), 'idRol', 'nomRol'),
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    return($model->status == 10) ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive');
                },
                'filter' => array(10 => "Active", 20 => "Inactive"),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>