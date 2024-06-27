<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtBaoGiaMuaSam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-bao-gia-mua-sam-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">

            <?= $form->field($model, 'id_ct_phieu_mua_sam')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($model->baoGia->phieuMuaSam->ctPhieuMuaSams, 'id', 'ten_thiet_bi'),
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
            <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'xuat_xu')->textInput(['maxlength' => true]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'nam_san_xuat')->textInput(["type"=>"number"]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'han_bao_hanh')->textInput(["type"=>"number"]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'so_luong')->textInput(["type"=>"number"]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'don_gia')->textInput(["type"=>"number"]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'dac_tinh_ky_thuat')->textarea(['rows' => 4]) ?>
        </div>

    </div>










    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>