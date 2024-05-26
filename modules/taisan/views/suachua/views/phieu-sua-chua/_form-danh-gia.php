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
.fa-star,.fa-solid {
  color: white;
  
}

.fa-star {
  font-size: 20px;
}
.fa-star,.fa-solid {
  color: yellow;
  
}
</style>
<div class="phieu-sua-chua-form">

    <?php $form = ActiveForm::begin([
        'action' => $model->isNewRecord ? ['/suachua/phieu-sua-chua/create'] : ['/suachua/phieu-sua-chua/update','id'=>$model->id]
    ]);?>
    
    
    <?=$form->field($model, 'danh_gia_sc')->textInput([
        'data-filled' => "fa-solid fa-star",
        'data-empty'=>'fa-regular fa-star',
        'class'=>'rating',
        'type'=>'hidden'
        ])?>


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