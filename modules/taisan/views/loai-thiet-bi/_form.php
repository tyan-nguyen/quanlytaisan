<?php
use app\modules\taisan\models\LoaiThietBi;
use app\widgets\forms\RadioWidget;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\taisan\models\LoaiThietBi */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
/*fixed select2 search conflict select2 form*/
.select2-container--krajee-bs5 .select2-selection--single {
    padding: 5px 1rem 5px 5px !important;
}
</style>

<div class="loai-thiet-bi-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'ma_loai')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-9">
            <?= $form->field($model, 'ten_loai')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="mb-3 row field-loathietbi-loai_thiet_bi">
    	<div class="col-sm-4">
        	<label class="col-md-12 control-label" for="loathietbi-loai_thiet_bi">
        	<?= $model->getAttributeLabel('loai_thiet_bi') ?>
        	</label>
    	</div>
    	<div class="col-sm-8">
    	<?= RadioWidget::widget([
    	    'model'=>$model,
    	    'attr'=>'loai_thiet_bi',
    	    'isNew'=>$model->isNewRecord,
        	'list'=>LoaiThietBi::getDmLoaiThietBi()
    	]) ?>
		<div class="invalid-feedback "></div></div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'truc_thuoc')->widget(Select2::classname(), [
                     'data' => (new LoaiThietBi())->getListTree(),
        		     'options' => ['placeholder' => 'Chọn '. $model->getAttributeLabel('truc_thuoc') .'...'],
        		     'pluginOptions' => [
        		         'allowClear' => true,
        		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
        		     ],
        		 ]);
        	 ?>
        </div>
    </div>
    <div>
        <div class="col">
            <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
