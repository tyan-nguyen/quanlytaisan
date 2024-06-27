<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\taisan\models\ThietBi;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;
use app\modules\bophan\models\BoPhan;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\ViTri;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\modules\bophan\models\DoiTac;
use app\modules\bophan\models\NhanVien;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuNhapHang */
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

$cus = new CustomFunc();
if ($model->han_bao_hanh != null) {
    $model->han_bao_hanh = $cus->convertYMDToDMY($model->han_bao_hanh);
}
?>

<div class="ct-phieu-nhap-hang-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'ma_thiet_bi')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'nam_san_xuat')->textInput() ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'xuat_xu')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'han_bao_hanh')->widget(DatePicker::classname(), [
                                'options' => [
                                    'placeholder' => 'Chọn ngày...'
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd/mm/yyyy'
                                ]
                	   ]);
                	?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
                             'data' => (new BoPhan())->getListTree(),
                		     'options' => [
                		         'id'=>'id-bo-phan2',
                		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan_quan_ly') .'...'
                		     ],
                		     'pluginOptions' => [
                		         'allowClear' => true,
                                 'width' => '100%',
                		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'), 
                		     ],
                		 ]);
                	 ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'id_nguoi_quan_ly')->widget(DepDrop::classname(), [
                            'options'=>[
                                'id'=>'id-nhan-vien2',
                                'placeholder' => 'Select ...'
                            ],
                            'data' => ($model->isNewRecord 
                                        ? $newArr 
                                        :[$model->id_nguoi_quan_ly=>$model->tenNguoiQuanLy]),
                            'type'=>DepDrop::TYPE_SELECT2,
                            'select2Options'=>[
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'width' => '100%',
                                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                                ],
                            ],
                            'pluginOptions'=>[
                                'depends'=>['id-bo-phan2'],
                                'width' => '100%',
                                //'initialize' => true,
                                'url'=>Url::to(['/kholuutru/depdrop/get-nhan-vien']),
                            ],
                        ]);
                   ?>
        </div>

    </div>
    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'id_he_thong')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(HeThong::find()->all(), 'id', 'ten_he_thong'),
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn hệ thống...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '100%',
                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                    ],
                ]);?>
        </div>
        <div class="col-4">


            <?= $form->field($model, 'id_vi_tri')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(ViTri::find()->all(), 'id', 'ten_vi_tri'),
                'language' => 'vi',
                'options' => ['placeholder' => 'Chọn vị trí...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%',
                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                ],
            ]);?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'id_thiet_bi_cha')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(ThietBi::find()->all(), 'id', 'ten_thiet_bi'),
                        'language' => 'vi',
                        'options' => ['placeholder' => 'Chọn thiết bị...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '100%',
                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                        ],
                    ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'id_hang_bao_hanh')->widget(Select2::classname(), [
                        'data' => DoiTac::getHangBaoHanhList(),
                        'options' => ['placeholder' => 'Chọn ' . $model->getAttributeLabel('id_hang_bao_hanh')],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '100%',
                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                        ],
                    ]);?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'id_nhien_lieu')->textInput() ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'id_don_vi_bao_tri')->widget(Select2::classname(), [
                             'data' => (new BoPhan())->getListTree(),
                		     'options' => [
                		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_don_vi_bao_tri') .'...'
                		     ],
                		     'pluginOptions' => [
                		         'allowClear' => true,
                                 'width' => '100%',
                		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'), 
                		     ],
                		 ]);
                	 ?>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'dac_tinh_ky_thuat')->textarea(['rows' => 4]) ?>
        </div>


    </div>

    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 3]) ?>
        </div>


    </div>















    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>