<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\widgets\forms\SwitchWidget;
use app\modules\taisan\models\ViTri;
use kartik\select2\Select2;
use app\modules\dungchung\models\CustomFunc;
use kartik\date\DatePicker;

$cus = new CustomFunc();
if($model->ngay_ngung_hoat_dong != null)
    $model->ngay_ngung_hoat_dong = $cus->convertYMDToDMY($model->ngay_ngung_hoat_dong);
?>

<div class="vi-tri-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-3">
             <?= $form->field($model, 'ma_vi_tri')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-9">
            <?= $form->field($model, 'ten_vi_tri')->textInput(['maxlength' => true]) ?>
        </div>
    </div> 
	
	 <div class="row">
        <div class="col-6">        	 
            <?= $form->field($model, 'mo_ta')->textarea(['rows' => 7]) ?>
        </div>
        <div class="col-6">
        	<?= $form->field($model, 'truc_thuoc')->widget(Select2::classname(), [
                     'data' => (new ViTri())->getListTree(),
        		     'options' => [
        		         'placeholder' => 'Chọn '. $model->getAttributeLabel('truc_thuoc') .'...',
        		         'data-dropdown-parent'=>"#offcanvasRight"
        		     ],
        		     'pluginOptions' => [
        		         'allowClear' => true,
        		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
        		     ],
        		 ]);
        	 ?>
        	 
        	<?= SwitchWidget::widget([
        	    'model'=>$model,
        	    'attr'=>'da_ngung_hoat_dong'
        	]) ?>
        	<div id="dNgayNgungHoatDong" <?= $model->da_ngung_hoat_dong==0?' style="display:none"': '' ?> >
            	<?= $form->field($model, 'ngay_ngung_hoat_dong')->widget(DatePicker::classname(), [
                            'options' => [
                                'placeholder' => 'Chọn ngày...'
                            ],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd/mm/yyyy'
                            ] ]);
            	?>
            </div>
        
            <?php // $form->field($model, 'id_layout')->textInput() ?>
        	
        	 <div class="row">
                <div class="col-6">
                    <?= $form->field($model, 'toa_do_x')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-6">
                     <?= $form->field($model, 'toa_do_y')->textInput(['maxlength' => true]) ?>
                </div>
            </div> 
              
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>

<script>
$('input[name="ViTri[da_ngung_hoat_dong]"]').change(function () {
    if(this.checked){
    	$('#dNgayNgungHoatDong').show();
    } else {
    	$('#dNgayNgungHoatDong').hide();
    }
});
</script>