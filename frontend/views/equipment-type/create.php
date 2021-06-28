<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EquipmentType */

$this->title = 'Создать шаблон';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'params' => $params
    ]) ?>

</div>
<?
for($i = 1; $i <= $params; $i++){
    $js = <<< JS
    $('#$i').on('input', function () {
            var msg = new Array();
            for(var i = 1; i <= $params; i++) 
                msg.push($('#' + i).val());
            $("#equipmenttype-equipment_template").val(JSON.stringify(msg));
        });
    JS;
    $this->registerJs($js, \yii\web\View::POS_END);
}


?>

