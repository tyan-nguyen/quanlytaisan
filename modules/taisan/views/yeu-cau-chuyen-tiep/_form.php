<?php

use app\modules\bophan\models\BoPhan;
use app\modules\taisan\models\YeuCauVanHanh;
use app\modules\bophan\models\NhanVien;
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\ThietBi;
use app\widgets\forms\RadioWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use wbraganca\dynamicform\DynamicFormWidget;
use wbraganca\dynamicform\DynamicFormAsset;
use yii\bootstrap5\Button;
use yii\web\View;
use app\widgets\SummaryAlert;
use app\modules\taisan\models\PhieuTraThietBiBase;
use app\modules\user\models\User;

DynamicFormAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanh */
/* @var $form yii\widgets\ActiveForm */

$newArr = [];

if ($model->isNewRecord) {
    if ($model->id_nguoi_yeu_cau != null) {
        $nv = NhanVien::findOne($model->id_nguoi_yeu_cau);
        if ($nv != null) {
            $newArr = [$model->id_nguoi_yeu_cau => $nv->ten_nhan_vien];
        }
    }
}

$cus = new CustomFunc();

$hieuLuc = $model->hieu_luc ?? null;
$isDraft = true;
if ($hieuLuc !== null && $hieuLuc !== 'NHAP') {
    $isDraft = false;
}
if($model->isNewRecord){
    if(User::hasRole('nNhanVien') && $model->id_nguoi_lap == NULL){
        $model->id_nguoi_lap = User::getCurrentNhanVienID();
    }
}
?>

<style>
    .legend {
        font-size: 14px;
        font-weight: bold;
        margin: 0px;
        padding: 0px;
    }
</style>

<div class="ts-yeu-cau-van-hanh-form container-fluid formInput">

    <?php $form = ActiveForm::begin(
        [
            'id' => 'dynamic-form',
            'options' => [
                'class' => 'form-horizontal', 'data-request-id' => $model->isNewRecord ? '' : $model->id
            ],
            'fieldConfig' => [
                'template' => '<div class="col-sm-12">{label}</div><div class="col-sm-12">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-md-12 control-label'],
            ]
        ]
    ); ?>

    <div class="row">
        <div class="col">
            <?php if ($model->hieu_luc === 'NHAP') { ?>
                <div class="form-group">
                    <?php
                    // Html::a('Gửi phê duyệt', ['yeu-cau-van-hanh/submit', 'id' => $model->id], [
                    //     'class' => 'btn btn-success text-right',
                    //     'style' => "margin-left:5px",
                    //     'data' => [
                    //         'method' => 'post',
                    //         'params' => ['hieu_luc' => 'CHODUYET'],
                    //     ],
                    // ]);
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <fieldset class="border p-2" style="margin:3px;">
                <legend class="legend">
                    <p>Thông tin lập phiếu</p>
                </legend>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'id_nguoi_lap')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                            'language' => 'vi',
                            'options' => [
                                'placeholder' => 'Chọn...',
                                //'disabled' => (!$isDraft || User::hasRole('nNhanVien',false))
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'width' => '100%',
                                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                            ],
                        ]); ?>
                    </div>

                    <div class="col-6">
                        <?= $form->field($model, 'ngay_lap')->widget(DatePicker::classname(), [
                            'options' => [
                                'placeholder' => 'Chọn ngày...',
                                'disabled' => !$isDraft
                            ],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'width' => '100%',
                                'format' => 'dd/mm/yyyy',
                                'todayHighlight' => true,
                                'todayBtn' => true,
                            ]
                        ]);
                        ?>
                    </div>

                    <div class="col-12">
                        <?= $form->field($model, 'noi_dung_lap')->textarea([
                            'maxlength' => true,
                            'disabled' => !$isDraft,
                            'rows'=>2
                        ]) ?>
                    </div>
                </div>
            </fieldset>


        </div>

        <div class="col-6">
            <fieldset class="border p-2" style="margin:3px;">
                <legend class="legend">
                    <p>Thông tin yêu cầu</p>
                </legend>
                <div class="row">
                    <!-- Bo phan Quan ly & Nguoi Yeu cau -->
                    <div class="col-6">
                        <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
                            'data' => (new BoPhan())->getListTree(),
                            'options' => [
                                'id' => 'id-bo-phan',
                                'placeholder' => 'Chọn ' . $model->getAttributeLabel('id_bo_phan_quan_ly') . '...',
                                'disabled' => !$isDraft

                            ],
                            'pluginOptions' => [
                                'width' => '100%',
                                'allowClear' => true,
                                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                            ],
                        ]);
                        ?>
                    </div>

                    <div class="col-6">

                        <?= $form->field($model, 'id_nguoi_yeu_cau')->widget(DepDrop::classname(), [
                            'options' => [
                                'id' => 'id-nhan-vien',
                                'placeholder' => 'Select ...',
                                'disabled' => !$isDraft

                            ],
                            'data' => ($model->isNewRecord
                                ? $newArr
                                : [$model->id_nguoi_yeu_cau => $model->nguoiYeuCau?$model->nguoiYeuCau->ten_nhan_vien:'']),
                            'type' => DepDrop::TYPE_SELECT2,
                            'select2Options' => [
                                'pluginOptions' => [
                                    'width' => '100%',
                                    'allowClear' => true,
                                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                ],
                            ],
                            'pluginOptions' => [
                                'depends' => ['id-bo-phan'],
                                'width' => '100%',
                                //'initialize' => true,
                                'url' => Url::to(['/kholuutru/depdrop/get-nhan-vien']),
                            ],
                        ]);
                        ?>
                    </div>

                    <div class="col-12">
                        <?= $form->field($model, 'ly_do')->textarea([
                            'maxlength' => true,
                            'disabled' => !$isDraft,
                            'rows'=>2
                        ]) ?>
                    </div>
                </div>

            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <fieldset class="border p-2" style="margin:3px">
                <legend class="legend">
                    <p>Phục vụ công trình</p>
                </legend>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'dia_diem')->textarea([
                            'maxlength' => true,
                            'disabled' => !$isDraft,
                            'rows'=>2
                        ]) ?>
                    </div>

                    <div class="col-6">
                        <?= $form->field($model, 'cong_trinh')->textarea([
                            'disabled' => !$isDraft,
                            'rows'=>2
                        ]) ?>
                    </div>


                </div>
            </fieldset>
        </div>
    </div>
    
    <?php if(User::hasPermission('qSapXepThietBi',false) ){ ?>    
    <!-- chi tiet thiet bi -->
    <div class="row">
    	<!-- <div class="col-md-12 mt-2">
       		<?= !$model->details ? SummaryAlert::widget([
			    'textMain'=>'Yêu cầu vận hành đã được duyệt!',
			    'textSummary'=>'Vui lòng thêm thiết bị điều chuyển cho yêu cầu.'
			]) : '' ?>
       </div>   --> 
    	<div class="col-md-12" id="chiTietBlock">
        	<?= $this->render('_form_chi_tiet_view', ['model'=>$model, 'ycvhctModel'=>$ycvhctModel]) ?>
        </div>
    </div>
	<?php } /*else if( (!$model->isNewRecord && $model->sauDuyet()) || !User::hasPermission('qSapXepThietBi',false) && $model->sauDuyet()){ ?>    
    <!-- chi tiet thiet bi sua -->
    <div class="row">  
    	<div class="col-md-12" id="chiTietBlock">
        	<?= $this->render('../yeu-cau-van-hanh/_form_chi_tiet_view', ['model'=>$model]) ?>
        </div>
    </div>
	<?php } */?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    $(document).ready(function() {
    $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
        console.log("Event triggered");
        console.log("Lenght: " + $(this).find('.date-picker').length);
        $(item).find('.date-picker').each(function() {
            $(this).kvDatepicker({
                autoclose: true,
                format: 'dd-mm-yyyy',
                todayHighlight: true
            });
        });
    });

    // Initialize date-picker on existing elements
    $('.date-picker').kvDatepicker({
            autoclose: true,
                format: 'dd-mm-yyyy',
            todayHighlight: true
    });
});
JS;

$this->registerJs($script);
?>