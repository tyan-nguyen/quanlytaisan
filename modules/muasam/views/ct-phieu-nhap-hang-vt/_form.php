<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\kholuutru\models\KhoLuuTru;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuNhapHangVt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-phieu-nhap-hang-vt-form">

    <?php $form = ActiveForm::begin(); ?>

   <div class='row'>
   <div class="col-12">
            <?= $form->field($model, 'id_kho')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(KhoLuuTru::find()->all(), 'id', 'ten_kho'),
            'options' => [
                'placeholder' => 'Chọn kho lưu trữ',
                'id' => 'id_kho',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
            ],
        ]) ?>
        </div>
        
   </div>

    <div class="row">
        <div class="col-12">
        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 3]) ?>

        </div>
        

    </div>

    
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
