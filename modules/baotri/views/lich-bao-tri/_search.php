<?php
use app\modules\baotri\models\LoaiBaoTri;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\ThietBi;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\KeHoachBaoTri */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ke-hoach-bao-tri-search">
	<?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>
	<div class="row">
		<div class="col-12">
			<?= $form->field($model, 'ten_cong_viec')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	
	<div class="row"> 
		<div class="col-6">
    	 <?= $form->field($model, 'ngay_thuc_hien')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => 'Chọn ngày...'
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy',
                    'todayHighlight' => true
                ]
            ]);
          ?>
		</div>
		<div class="col-6">
    	 <?= $form->field($model, 'denNgay')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => 'Chọn ngày...'
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy',
                    'todayHighlight' => true
                ]
            ]);
          ?>
		</div>
	</div>
	
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
