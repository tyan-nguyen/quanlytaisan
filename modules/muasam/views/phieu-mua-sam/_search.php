<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\bophan\models\BoPhan;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\modules\bophan\models\NhanVien;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuMuaSam */
/* @var $form yii\widgets\ActiveForm */


$newArr = [];
if($model->isNewRecord){
    if($model->id_nguoi_quan_ly != null){
        $nv = NhanVien::findOne($model->id_nguoi_quan_ly);
        if($nv != null){
            $newArr = [$model->id_nguoi_quan_ly => $nv->ten_nhan_vien];
        }
    }
}
?>

<div class="phieu-mua-sam-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>
    <?=$form->field($model, 'ngay_yeu_cau')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Chọn ngày...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
            ],
        ]);?>

    <!-- <?= $form->field($model, 'id_nguoi_duyet')->textInput() ?> -->

    <?= $form->field($model, 'trang_thai')->dropDownList($model->getDmTrangThai(), ['prompt'=>'--Chọn--']) ?>

    <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
            'data' => (new BoPhan())->getListTree(),
            'options' => [
                'id'=>'id-bo-phan-search',
                'placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan_quan_ly') .'...',
                'data-dropdown-parent'=>"#offcanvasRight"
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                //'dropdownParent' => new yii\web\JsExpression('$("#offcanvasRight")'), 
            ],
        ]);
    ?>

    <?= $form->field($model, 'id_nguoi_quan_ly')->widget(DepDrop::classname(), [
        'options'=>[
            'id'=>'id-nhan-vien-search',
            'placeholder' => 'Select ...',
            'data-dropdown-parent'=>"#offcanvasRight"
        ],
        'data' => ($model->id_nguoi_quan_ly 
                    ? $newArr 
                    :[$model->id_nguoi_quan_ly=>$model->tenNguoiQuanLy]),
        'type'=>DepDrop::TYPE_SELECT2,
        'select2Options'=>[
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                //'dropdownParent' => new yii\web\JsExpression('$("#offcanvasRight")'),
            ],
        ],
        'pluginOptions'=>[
            'depends'=>['id-bo-phan-search'],
            //'initialize' => true,
            'url'=>Url::to(['/kholuutru/depdrop/get-nhan-vien']),
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