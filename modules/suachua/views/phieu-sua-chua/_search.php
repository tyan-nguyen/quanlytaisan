<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\ThietBiBase;
use app\modules\bophan\models\BoPhan;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */
/* @var $form yii\widgets\ActiveForm */
/* $custom = new CustomFunc();
if($model->ngay_sua_chua){
    $model->ngay_sua_chua = $custom->convertYMDToDMY($model->ngay_sua_chua);
}
if($model->ngay_hoan_thanh){
    $model->ngay_hoan_thanh = $custom->convertYMDToDMY($model->ngay_hoan_thanh);
} */
?>

<div class="phieu-sua-chua-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>
    
    <?=$form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(ThietBiBase::find()->all(), 'id', 'ten_thiet_bi'),
                'language' => 'vi',
                'options' => [
                    'placeholder' => 'Chọn thiết bị...',
                    'data-dropdown-parent'=>"#offcanvasRight"
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%',
                ],
            ]);?>
    
    <?=$form->field($model, 'id_tt_sua_chua')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(BoPhan::find()->where(['la_dv_sua_chua'=>1])->all(), 'id', 'ten_bo_phan'),
            'language' => 'vi',
            'options' => [
                'placeholder' => 'Chọn trung tâm sửa chữa...',
                'data-dropdown-parent'=>'#offcanvasRight'                
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%'
             ],
     ]);?>

    <?=$form->field($model, 'ngay_sua_chua')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Chọn ngày...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
            ],
        ]);?>

     <?=$form->field($model, 'ngay_hoan_thanh')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Chọn ngày...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
            ],
        ]);?>
   
    <?= $form->field($model, 'trang_thai')->dropDownList($model->getDmTrangThai(), ['prompt'=>'-Chọn trạng thái-']) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
