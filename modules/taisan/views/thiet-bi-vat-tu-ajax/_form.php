<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\ThietBi;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;
use app\modules\kholuutru\models\DmVatTu;
use PHPUnit\TextUI\XmlConfiguration\Php;
use app\modules\kholuutru\models\KhoLuuTru;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanhCt */
/* @var $form yii\widgets\ActiveForm */
/* if(!$model->isNewRecord){
    $custom = new CustomFunc();
} */
?>

<div class="ts-thiet-bi-vat-tu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-md-12">
    <?=$form->field($model, 'id_vat_tu')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(DmVatTu::find()->all(), 'id', 'ten_vat_tu'),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn vật tư/phụ tùng...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%',
            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
        ],
        'disabled'=>!$model->isNewRecord
    ]);?>
    </div>
    <div class="col-md-12">
    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
    <?= $form->field($model, 'so_serial')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12">
    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 3]) ?>
    </div>
    <div class="col-md-6">
    <?=$form->field($model, 'trang_thai')->widget(Select2::classname(), [
        'data' => $model->getDmTrangThai(),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn trạng thái...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%',
            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
        ],
    ]);?>
    </div>
    <div class="col-md-6">
    <?=$form->field($model, 'id_kho')->widget(Select2::classname(), [
        'data' => KhoLuuTru::getList(),
        'language' => 'vi',
        'options' => [
            'placeholder' => 'Chọn kho(cho VT hỏng)...',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'width' => '100%',
            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
        ],
    ]);?>
    </div>
    
    <div class="col-md-12">
    
	<?php
	if($model->isNewRecord){
	   echo $form->field($model, 'tru_ton_kho')->checkbox(['checked'=>true]);
	} else {
	    echo $form->field($model, 'tru_ton_kho')->checkbox(['disabled'=>true]);
	}
	?>
	</div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
	
	</div>

    <?php ActiveForm::end(); ?>
    
</div>
