<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtBaoGiaMuaSamVt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-bao-gia-mua-sam-vt-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-6">

            <?= $form->field($model, 'id_ct_phieu_mua_sam')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($model->baoGia->phieuMuaSam->ctPhieuMuaSams, 'id', 'ten_vat_tu'),
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn loại thiết bị...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '100%',  
                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                    ],
                    
                ]);?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'so_luong')->textInput(["type"=>"number"]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'don_gia')->textInput(["type"=>"number"]) ?>
        </div>

    </div>
    <div class='row'>
        <div class="col-12">
            <?= $form->field($model, 'hang_san_xuat')->textInput() ?>
        </div>
    </div>
    <div class='row'>
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
