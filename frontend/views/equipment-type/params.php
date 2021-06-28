<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EquipmentType */

$this->title = 'Создать шаблон';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-type-params">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="equipment-type-params">

        <p>Введите колличество учитываемых параметров создаваемого типа оборудования</p>

        <form action="create" method="get">
            <input type="number" name="params" value="1" min="1">
            <input type="submit" class="btn btn-success">
        </form>

    </div>


</div>
