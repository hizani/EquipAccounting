<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AccountedEquipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounted-equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equipment_type_id')->hiddenInput()?>

    <?= Html::dropDownList('eq-type',null,\yii\helpers\ArrayHelper::map(\common\models\EquipmentType::find()->all(), 'id', 'name'), ['class'=>'form-control', 'id'=>'eq-type', 'disabled'=>'true'])?>

    <?= $form->field($model, 'equipment_attributes')->textarea(['readonly' => 'readonly', 'rows' => count($type_attributes)+1]) ?>

    <?for($i = 0; $i < count($type_attributes); $i++){
    ?>
    <label class="control-label" for="<?=$i?>"><?=$type_attributes[$i]?></label>
    <input type="text" id="<?=$i?>" name="<?=$type_attributes[$i]?>" class="form-control"/><br/>
    <?}?>

    <?= $form->field($model, 'is_in_stock')->checkbox() ?>

    <?= $form->field($model, 'classroom_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Classroom::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
