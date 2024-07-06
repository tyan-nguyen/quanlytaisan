<?php
use app\modules\dungchung\models\CustomFunc;
use app\modules\suachua\models\DmTTSuaChua;
use app\modules\taisan\models\ThietBiBase;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\widgets\forms\RadioWidget;
use app\modules\bophan\models\BoPhan;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */
/* @var $form yii\widgets\ActiveForm */
$cus = new CustomFunc();
if ($model->ngay_sua_chua != null) {
    $model->ngay_sua_chua = $cus->convertYMDToDMY($model->ngay_sua_chua);
}

if ($model->ngay_du_kien_hoan_thanh != null) {
    $model->ngay_du_kien_hoan_thanh = $cus->convertYMDToDMY($model->ngay_du_kien_hoan_thanh);
}

if ($model->ngay_hoan_thanh != null) {
    $model->ngay_hoan_thanh = $cus->convertYMDToDMY($model->ngay_hoan_thanh);
}
if(!$model->isNewRecord){
    $model->phi_linh_kien=number_format($model->phi_linh_kien);
    $model->phi_khac=number_format($model->phi_khac);
    $model->tong_tien=number_format($model->tong_tien);
}
?>

<div class="phieu-sua-chua-form">

    <?php $form = ActiveForm::begin([
        'action' => $model->isNewRecord ? ['/suachua/phieu-sua-chua/create'] : ['/suachua/phieu-sua-chua/update','id'=>$model->id]
    ]);?>
    <div class="row">
        <div class="col-6">
        <div class="form-group">
            <?=$form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(ThietBiBase::find()->all(), 'id', 'ten_thiet_bi'),
                'language' => 'vi',
                'options' => [
                    'placeholder' => 'Chọn thiết bị...'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%',
                    'dropdownParent' => Yii::$app->request->isAjax ? new yii\web\JsExpression('$("#ajaxCrudModal")') : null,
                ],
            ]);?>
        </div>
        </div>
        <div class="col-6">
        <?=$form->field($model, 'id_tt_sua_chua')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(BoPhan::find()->where(['la_dv_sua_chua'=>1])->all(), 'id', 'ten_bo_phan'),
                                    'language' => 'vi',
                                    'options' => [
                                        'placeholder' => 'Chọn trung tâm sửa chữa...'
                                        
                                    ],
                                    'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%',
                    'dropdownParent' => Yii::$app->request->isAjax ? new yii\web\JsExpression('$("#ajaxCrudModal")') : null,
                ],
            ]);?>
        </div>
        
    </div>


    <div class="row">
        <div class="col">
            <?=$form->field($model, 'ngay_sua_chua')->widget(DatePicker::classname(), [
    'options' => [
        'placeholder' => 'Chọn ngày...',
    ],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd/mm/yyyy',
    ],
]);?>
        </div>
        <div class="col">
            <?=$form->field($model, 'ngay_du_kien_hoan_thanh')->widget(DatePicker::classname(), [
    'options' => [
        'placeholder' => 'Chọn ngày...',
    ],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'dd/mm/yyyy',
    ],
]);?>
        </div>
        <?php if (!$model->isNewRecord) {?>
        <div class="col">
            <?=$form->field($model, 'ngay_hoan_thanh')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => 'Chọn ngày...',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd/mm/yyyy',
                ],
            ]);?>
        </div>
        <?php }?>
    </div>


    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'dia_chi')->textInput(['maxlength' => true])?>
        </div>
        
    </div>

    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'ghi_chu1')->textarea(['rows' => 4])?>
        </div>

    </div>

    <?php if (!Yii::$app->request->isAjax ) {?>
    <div class="row">
        <div class="col-4">
            <?=$form->field($model, 'phi_linh_kien')->textInput(['disabled' => true])?>
        </div>
        <div class="col-4">
            <?=$form->field($model, 'phi_khac')->textInput(['disabled' => true])?>
        </div>
        <div class="col-4">
            <?=$form->field($model, 'tong_tien')->textInput(['disabled' => true])?>
        </div>
        
        
    </div>
    <?php }?>




    
    <div class="form-group">
    <?php if (!Yii::$app->request->isAjax && $model->trang_thai !== 'completed') {?>
    <?= Html::a('Hoàn thành sửa chữa', null, [
                'class' => 'btn btn-success',
                'style'=>"margin-left:5px",
                'data' => [
                    'method' => 'post',
                    'params'=>['PhieuSuaChua[trang_thai]'=>'completed']
                ]
            ]);
    ?>
        <?=Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
        <?php } ?>
        <?= Html::a('Print phiếu sửa chữa', null, [
                'class' => 'btn btn-info',
                'id'=>"print-button",
                'style'=>"margin-left:5px"
            ]);
        ?>
        <?= Html::a('Print phiếu xuất kho', null, [
                'class' => 'btn btn-info',
                'id'=>"print-button-phieu-xuat-kho",
                'style'=>"margin-left:5px"
            ]);
        ?>
        
    </div>
    
    
    
    <?php ActiveForm::end();?>
    
    
</div>
<div id="print-phieu-sua-chua-content" class="print-phieu-sua-chua-content">
</div>
<div id="print-phieu-xuat-kho-content" class="print-phieu-sua-chua-content">
</div>
<?php


$js = <<< JS
$(document).ready(function() {
    $("#print").click(function(){
        $('.print-phieu-sua-chua').printThis();
    });
    var modelId = '{$model->id}';
    $('#print-button').on('click', function() {
        $.ajax({
            url: '/suachua/phieu-sua-chua/print-view?id='+ modelId,
            type: 'GET',
            success: function(data) {
                $('#print-phieu-sua-chua-content').html(data);
                $('.print-phieu-sua-chua').printThis();
            },
            error: function() {
                alert('Đã xảy ra lỗi trong khi tải nội dung.');
            }
        });
    });
    $('#print-button-phieu-xuat-kho').on('click', function() {
        $.ajax({
            url: '/suachua/phieu-sua-chua/print-phieu-xuat-kho-view?id='+ modelId,
            type: 'GET',
            success: function(data) {
                $('#print-phieu-xuat-kho-content').html(data);
                $('.print-phieu-xuat-kho').printThis();
            },
            error: function() {
                alert('Đã xảy ra lỗi trong khi tải nội dung.');
            }
        });
    });
});
JS;
    $this->registerJs($js, \yii\web\View::POS_READY);
?>

