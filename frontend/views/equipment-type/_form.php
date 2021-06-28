<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EquipmentType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equipment_template')->hiddenInput() ?>
    <?php
   for($i = 1; $i <= $params; $i++){
    ?>
       <label class="control-label" for="<?=$i?>"><?=$i?></label>
        <input type="text" id="<?=$i?>" name="<?=$i?>" class="form-control"/><br/>
    <?}?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
