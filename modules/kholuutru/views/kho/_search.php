<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\modules\kholuutru\models\KhoLuuTru;
use kartik\select2\Select2;
use app\modules\bophan\models\BoPhan;
use kartik\depdrop\DepDrop;
use app\modules\bophan\models\NhanVien;

/* @var $this yii\web\View */
/* @var $model app\modules\kholuutru\models\KhoLuuTru */
/* @var $form yii\widgets\ActiveForm */

$newArr = [];
if($model->isNewRecord){
    if($model->id_nguoi_quan_ly != null){
        $nv = NhanVien::findOne($model->id_nguoi_quan_ly);
        if($nv != null){
            $newArr = [$model->id_nguoi_quan_ly => $nv->ten_nhan_vien];
            //$newArr = NhanVien::getListThuocBoPhan($model->id_nguoi_quan_ly);
        }
    }
}

?>

<style>
/*fixed select2 search conflict select2 form*/
.select2-container--krajee-bs5 .select2-selection--single {
    padding: 5px 1rem 5px 5px !important;
}
</style>

<div class="kho-luu-tru-search">

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

    <?= $form->field($model, 'ma_kho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_kho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loai_kho')->widget(Select2::classname(), [
             'data' => KhoLuuTru::getDmLoaiKho(),
    	     'options' => [
    	         'placeholder' => 'Chọn '. $model->getAttributeLabel('loai_kho') .'...',
    	         'data-dropdown-parent'=>"#offcanvasRight"
    	     ],
    	     'pluginOptions' => [
    	         'allowClear' => true,
    	         //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
    	     ],
    	 ]);
     ?>   

    <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
             'data' => (new BoPhan())->getListTree(),
		     'options' => [
		         'id'=>'id-bo-phan-search',
		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan_quan_ly') .'...',
		         'data-dropdown-parent'=>"#offcanvasRight"
		     ],
		     'pluginOptions' => [
		         'allowClear' => true,
		         //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
		     ],
		 ]);
	 ?>     
	 
	 <?php  
            //echo Html::hiddenInput('input-type-1', $model->id_bo_phan_quan_ly, ['id' => 'input-type-1']);
            //echo Html::hiddenInput('input-type-2', $model->id_nguoi_quan_ly, ['id' => 'input-type-2']);
            echo $form->field($model, 'id_nguoi_quan_ly')->widget(DepDrop::classname(), [
                'options'=>[
                    'id'=>'id-nhan-vien-search',
                    'placeholder' => 'Chọn...',
                    'data-dropdown-parent'=>"#offcanvasRight"
                ],
                'data' => $model->isNewRecord?$newArr:[$model->id_nguoi_quan_ly=>$model->nguoiQuanLy->ten_nhan_vien],
                //'data' => $model->isNewRecord?$newArr:NhanVien::getListThuocBoPhan($model->id_nguoi_quan_ly),
                'type'=>DepDrop::TYPE_SELECT2,
                'select2Options'=>[
                    'pluginOptions' => [
                        'allowClear' => true,
                        //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                    ],
                ],
                'pluginOptions'=>[
                    'depends'=>['id-bo-phan-search'],
                    //'initialize' => true,
                    'url'=>\yii\helpers\Url::to(['/kholuutru/depdrop/get-nhan-vien']),
                    //'params' => ['input-type-1', 'input-type-2']
                ],
            ]);
       ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
