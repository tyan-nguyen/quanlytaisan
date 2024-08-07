<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\kholuutru\models\KhoLuuTru;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuMuaSamVt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-phieu-mua-sam-vt-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <div class="row">
        <div class="col-5">
            <?= $form->field($model, 'ten_vat_tu')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-5">
            <?= $form->field($model, 'id_kho')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(KhoLuuTru::find()->all(), 'id', 'ten_kho'),
            'options' => [
                'placeholder' => 'Chọn kho lưu trữ',
                'id' => 'id_kho',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
            ],
        ]) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'so_luong')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-6">

        <?=$form->field($model, 'hang_san_xuat')->textInput(['maxlength' => true])?>
        </div>

    </div>

    

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
