<?php

use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\ThietBi;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TsPhieuTraThietBi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ts-phieu-tra-thiet-bi-search">

    <?php $form = ActiveForm::begin([
        'id' => 'myFilterForm',
        'method' => 'post',
        'options' => [
            'class' => 'myFilterForm'
        ]
    ]); ?>
    
    <?= $form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
        'data' => ThietBi::getListWithStatus(),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn...',
            'data-dropdown-parent' => "#offcanvasRight"
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ])->label('Thiết bị');
    ; ?>

    <?= $form->field($model, 'id_nguoi_tra')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn...',
            'data-dropdown-parent' => "#offcanvasRight"
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ]); ?>

    <?= $form->field($model, 'id_nguoi_nhan')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn...',
            'data-dropdown-parent' => "#offcanvasRight"
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ]); ?>
    
     <?= $form->field($model, 'nguoi_tao')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn...',
            'data-dropdown-parent' => "#offcanvasRight"
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%'
        ],
    ])->label('Nhân viên tạo phiếu');
    ; ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>