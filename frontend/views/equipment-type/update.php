<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EquipmentType */

$this->title = 'Update Equipment Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Equipment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="equipment-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
