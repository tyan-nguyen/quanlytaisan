<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\kholuutru\models\KhoLuuTru;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChuaVatTu */
/* @var $form yii\widgets\ActiveForm */
$vatTu=$model->vatTu;
?>

<div class="phieu-sua-chua-vat-tu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
        <div class="form-group">
        
        <?= $form->field($model, 'id_kho_luu_tru')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(KhoLuuTru::find()->all(), 'id', 'ten_kho'),
            'options' => [
                'placeholder' => 'Chọn kho lưu trữ',
                'id' => 'id_kho_luu_tru',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
            ],
        ]) ?>
    </div>

        </div>
        <div class="col-6">
        <?= $form->field($model, 'ten_vat_tu')->textInput() ?>
        </div>
        
    </div>

    <div class="row">
    <div class="col-6">
        <?= $form->field($model, 'don_vi_tinh')->textInput() ?>
        </div>
        <div class="col-6">
        <?= $form->field($model, 'so_luong')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'hang_san_xuat')->textInput() ?>
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