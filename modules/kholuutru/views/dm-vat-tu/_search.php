<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\kholuutru\models\KhoLuuTru;

/* @var $this yii\web\View */
/* @var $model app\modules\kholuutru\models\DmVatTu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dm-vat-tu-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ten_vat_tu')->textInput(['maxlength' => true]) ?>
    
    <label>Kho lưu trữ</label>
    <?= $form->field($model, 'id_kho')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(KhoLuuTru::find()->all(), 'id', 'ten_kho'),
                'options' => [
                    'placeholder' => 'Chọn kho lưu trữ',
                    'id' => 'id_kho',
                    'data-dropdown-parent'=>"#offcanvasRight"
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width'=>'100%'
                ],
            ])->label(false) ?>
            
    <div class="row">
    	<div class="col-md-6">
    		 <?= $form->field($model, 'trangThaiSoLuong')->dropDownList([
                    'LON'=>'Có số lượng (>0)',
                    'NHO'=>'Không có tồn kho (<=0)'
                ],[
                    'prompt'=>'-Chọn-'
                ])->label('Số lượng') ?>
    	</div>
    	<div class="col-md-6">
    		 <?= $form->field($model, 'trang_thai')->dropDownList($model->getDmTrangThai(),[
                'prompt'=>'-Chọn-'
            ]) ?>
    	</div>
    </div>

    <?php // $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'don_gia')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'ngay_tao')->textInput() ?>

    <?php // $form->field($model, 'nguoi_tao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
