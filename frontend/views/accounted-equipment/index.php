<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountedEquipmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оборудование на учете';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounted-equipment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить оборудование', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'equipment_type_id',
            //'equipment_attributes:ntext',
            'is_in_stock',
            'classroom.name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
