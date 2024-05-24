<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\modules\taisan\models\LoaiThietBi;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\modules\taisan\models\LoaiThietBiSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<style>
/*fixed select2 search conflict select2 form*/
.select2-container--krajee-bs5 .select2-selection--single {
    padding: 5px 1rem 5px 5px !important;
}
</style>

<div class="loai-thiet-bi-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm form-horizontal'
            ],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => '<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-md-12 control-label'],
            ],
      	]); ?>

    <?= $form->field($model, 'ma_loai') ?>

    <?= $form->field($model, 'ten_loai') ?>
    
    <?= $form->field($model, 'loai_thiet_bi')->widget(Select2::classname(), [
            'data' => LoaiThietBi::getDmLoaiThietBi(),
            'hideSearch'=>true,
            'options' => [
                'placeholder' => 'Chọn '. $model->getAttributeLabel('loai_thiet_bi') .'...',
                'data-dropdown-parent'=>"#offcanvasRight"
            ],
            'pluginOptions' => [
                'allowClear' => true,
                //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
            ],
        ]);
    ?>

    <?= $form->field($model, 'truc_thuoc')->widget(Select2::classname(), [
         'data' => (new LoaiThietBi())->getListTree(),
	     'options' => [
	         'placeholder' => 'Chọn '. $model->getAttributeLabel('truc_thuoc') .'...',
	         'data-dropdown-parent'=>"#offcanvasRight"
	     ],
	     'pluginOptions' => [
	         'allowClear' => true,
	         //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
	     ],
	 ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	    <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
