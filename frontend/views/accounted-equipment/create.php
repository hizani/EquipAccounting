<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AccountedEquipment */

$this->title = 'Добавить оборудование';
$this->params['breadcrumbs'][] = ['label' => 'Учитываемое оборудование', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?
$jsoned_attributes = $type->getAttributes(array('equipment_template'))["equipment_template"];
$type_attributes = json_decode($jsoned_attributes);
?>

<div class="accounted-equipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type_attributes' => $type_attributes
    ]) ?>

</div>

<?
$count_attributes = count($type_attributes);
$new_line = "\\n";
for($i = 0; $i < $count_attributes; $i++){
    $js = <<< JS
    $('#$i').on('input', function () {
            var msg = "";
            for(var i = 0; i < $count_attributes; i++) {
                msg += $('#' + i).attr("name") + ": " + $('#' + i).val() + "$new_line";
                $("#accountedequipment-equipment_attributes").val(msg);
            }
        });
    JS;
    $this->registerJs($js, \yii\web\View::POS_END);
}
?>

<?
$js = <<< JS
    var msg = "";
            for(var i = 0; i < $count_attributes; i++) {
                msg += $('#' + i).attr("name") + ": " + $('#' + i).val() + "$new_line";
                $("#accountedequipment-equipment_attributes").val(msg);
            }
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>

<?
$js = <<< JS
    $('#accountedequipment-classroom_id').append(new Option("На складе", 0));
    $('#accountedequipment-classroom_id').on('input', function() {
      if($('#accountedequipment-classroom_id').val() == 0){
          $('#accountedequipment-is_in_stock').prop( "checked", true );
          $('#accountedequipment-classroom_id').prop( "disabled", true );
      }
      else{
          $('#accountedequipment-is_in_stock').prop( "checked", false );
          $('#accountedequipment-classroom_id').prop( "disabled", false );
      }
    });
    
    $('#accountedequipment-is_in_stock').on('input', function() {
      if($('#accountedequipment-is_in_stock').is(":checked")){
          $('#accountedequipment-classroom_id').val("0");
          $('#accountedequipment-classroom_id').prop( "disabled", true );
      }
      else{
          $('#accountedequipment-classroom_id').val("1");
          $('#accountedequipment-classroom_id').prop( "disabled", false );
      }
    });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>

<?
$js = <<< JS
     $('#accountedequipment-equipment_type_id').val($type_id);
    $('#eq-type').val($type_id);
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>
