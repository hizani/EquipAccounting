<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AccountedEquipment */

$this->title = 'Добавить оборудование';
$this->params['breadcrumbs'][] = ['label' => 'Accounted Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounted-equipment-type">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="accounted-equipment-type">
        <?= Html::beginForm('create', 'get')?>
        <?= Html::dropDownList('type_id', null,\yii\helpers\ArrayHelper::map(\common\models\EquipmentType::find()->all(), 'id', 'name'), ['class' => 'form-control' ])?>
        <?= Html::submitButton('Продолжить',['class'=>'btn btn-success'])?>
        <?= Html::endForm()?>

    </div>


</div>
