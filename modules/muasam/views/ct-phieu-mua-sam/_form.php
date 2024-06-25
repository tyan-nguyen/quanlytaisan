<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\LoaiThietBi;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuMuaSam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-phieu-mua-sam-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-5">
            <?= $form->field($model, 'ten_thiet_bi')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-5">
            <?= $form->field($model, 'id_loai_thiet_bi')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(LoaiThietBi::find()->all(), 'id', 'ten_loai'),
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn loại thiết bị...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '100%',
                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                    ],
                    
                ]);?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'so_luong')->textInput(['type'=>'number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'dac_tinh_ky_thuat')->textarea(['rows' => 4]) ?>
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