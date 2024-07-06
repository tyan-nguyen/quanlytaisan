<?php
use app\modules\dungchung\models\CustomFunc;
use app\modules\suachua\models\DmTTSuaChua;
use app\modules\taisan\models\ThietBiBase;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\widgets\forms\RadioWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */
/* @var $form yii\widgets\ActiveForm */
$cus = new CustomFunc();


?>
<style>
.fa-star {
  color: rgb(236, 240, 241);
  
}

.fa-star {
  font-size: 20px;
}
.fa-star, .fa-solid {
  color: rgb(236, 240, 241);
  
  
}
.fa-star, .fa-regular {
  color: rgb(241, 196, 15);
  
}
</style>
<div class="phieu-mua-sam-form">

    <?php $form = ActiveForm::begin([
        'action' => $model->isNewRecord ? ['/muasam/phieu-mua-sam/create'] : ['/muasam/phieu-mua-sam/update','id'=>$model->id]
    ]);?>
    
    <div class="row">
        <div class="col-6">
    <?=$form->field($model, 'danh_gia_ms')->textInput([
        'data-filled' => "fa-solid fa-star",
        'data-empty'=>'fa-regular fa-star',
        'class'=>'rating',
        'type'=>'hidden'
        ])?>
        
        
        </div>
        <div class="col-6">
    <?=$form->field($model, 'danh_gia_bg')->textInput([
        'data-filled' => "fa-solid fa-star",
        'data-empty'=>'fa-regular fa-star',
        'class'=>'rating',
        'type'=>'hidden'
        ])?>
        
        
        </div>
</div>
    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'ghi_chu2')->textarea(['rows' => 4])?>
        </div>

    </div>

    

    




    <?php if (!Yii::$app->request->isAjax) {?>
    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>
    <?php }?>

    <?php ActiveForm::end();?>

</div>

<?php


$js = <<< JS
$(document).ready(function() {
  $('.SlectBox').SumoSelect();
    
});
JS;
    $this->registerJs($js, \yii\web\View::POS_READY);
?>