<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\widgets\forms\SwitchWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\bophan\models\BoPhan;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\taisan\models\ThietBi;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
//use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\BoPhan */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
/*fixed select2 search conflict select2 form*/
.select2-container--krajee-bs5 .select2-selection--single {
    padding: 5px 1rem 5px 5px !important;
}
</style>

<div class="thiet-bi-search">

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

    <?= $form->field($model, 'ma_thiet_bi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_thiet_bi')->textInput(['maxlength' => true]) ?>
    
	<?= $form->field($model, 'id_loai_thiet_bi')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(LoaiThietBi::find()->all(), 'id', 'ten_loai'),
            'language' => 'vi',
            'options' => [
                'placeholder' => 'Chọn loại thiết bị...',
                'data-dropdown-parent'=>"#offcanvasRight"
            ],
            'pluginOptions' => [
                'allowClear' => true,
                //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
            ],
            
        ]);?>
        
        <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
                'data' => (new BoPhan())->getListTree(),
    		     'options' => [
    		         'id'=>'id-bo-phan-search',
    		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan_quan_ly') .'...',
    		         'data-dropdown-parent'=>"#offcanvasRight"
    		     ],
    		     'pluginOptions' => [
    		         'allowClear' => true,
    		         //'dropdownParent' => new yii\web\JsExpression('$("#offcanvasRight")'), 
    		     ],
    		 ]);
    	?>
    	
    	<?= $form->field($model, 'id_nguoi_quan_ly')->widget(DepDrop::classname(), [
                            'options'=>[
                                'id'=>'id-nhan-vien',
                                'placeholder' => 'Chọn người quản lý ...',
                                'data-dropdown-parent'=>"#offcanvasRight"
                            ],
                            'data' => [],
                            'type'=>DepDrop::TYPE_SELECT2,
                            'select2Options'=>[
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ],
                            'pluginOptions'=>[
                                'depends'=>['id-bo-phan-search'],
                                //'initialize' => true,
                                'url'=>Url::to(['/kholuutru/depdrop/get-nhan-vien']),
                            ],
                        ]);
                   ?>
    	
    	<?= $form->field($model, 'trang_thai')->dropDownList(ThietBi::getDmTrangThai(), ['prompt'=>'--Chọn--']) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
