<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AccountedEquipment */

$this->title = 'Update Accounted Equipment: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Accounted Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accounted-equipment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
