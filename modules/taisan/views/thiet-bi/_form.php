<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\taisan\models\ThietBi;
use kartik\date\DatePicker;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\ViTri;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\LopHuHong;
use app\widgets\forms\ImageWidget;
use app\widgets\forms\DocumentWidget;
use app\modules\bophan\models\DoiTac;
use app\modules\bophan\models\BoPhan;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\widgets\forms\RadioWidget;
use app\modules\dungchung\models\CustomFunc;

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
if($model->ngay_ngung_hoat_dong != null)
    $model->ngay_ngung_hoat_dong = $cus->convertYMDToDMY($model->ngay_ngung_hoat_dong);
if($model->han_bao_hanh != null)
    $model->han_bao_hanh = $cus->convertYMDToDMY($model->han_bao_hanh);
if($model->ngay_mua != null)
    $model->ngay_mua = $cus->convertYMDToDMY($model->ngay_mua);
if($model->ngay_dua_vao_su_dung != null)
    $model->ngay_dua_vao_su_dung = $cus->convertYMDToDMY($model->ngay_dua_vao_su_dung);


/* @var $this yii\web\View */
/* @var $model app\models\TsThietBi */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .legend{
        font-size: 14px; 
        font-weight: bold; 
        margin: 0px; 
        padding: 0px;
        background: 040404;
    }
</style>

<div class="ts-thiet-bi-form container-fluid formInput">
    <?php $form = ActiveForm::begin(
            ['options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '<div class="col-sm-12">{label}</div><div class="col-sm-12">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-md-12 control-label'],
            ],
        ]); ?>

    <div class="row">

        <div class="col-5">
            <fieldset class="border p-2" style="margin:3px;"><!--Thông tin chung -->
            <legend class="legend"><p>Thông tin chung</p></legend>
            <div class="row">
                <div class="col-3">
                    <?= $form->field($model, 'ma_thiet_bi')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-9">
                    <?= $form->field($model, 'ten_thiet_bi')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- <?= $form->field($model, 'id_thiet_bi_cha')->textInput() ?> -->
                    <?= $form->field($model, 'id_thiet_bi_cha')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(ThietBi::find()->all(), 'id', 'ten_thiet_bi'),
                        'language' => 'vi',
                        'options' => ['placeholder' => 'Chọn thiết bị...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);?>
                </div>
                <div class="col">
                <?= $form->field($model, 'id_loai_thiet_bi')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(LoaiThietBi::find()->all(), 'id', 'ten_loai'),
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn loại thiết bị...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                    ],
                    
                ]);?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <?= $form->field($model, 'id_he_thong')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(HeThong::find()->all(), 'id', 'ten_he_thong'),
                    'language' => 'vi',
                    'options' => ['placeholder' => 'Chọn hệ thống...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                    ],
                ]);?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'id_vi_tri')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(ViTri::find()->all(), 'id', 'ten_vi_tri'),
                        'language' => 'vi',
                        'options' => ['placeholder' => 'Chọn vị trí...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                        ],
                    ]);?>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col">
                    <?= $form->field($model, 'id_layout')->textInput() ?>
                </div>
            </div> -->
            </fieldset>

            <fieldset class="border p-2" style="margin:3px"><!--Đặc tính kỹ thuật -->
            <legend class="legend"><p>Thông tin kỹ thuật</p></legend>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'nam_san_xuat')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'xuat_xu')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'id_hang_bao_hanh')->widget(Select2::classname(), [
                        'data' => DoiTac::getHangBaoHanhList(),
                        'options' => ['placeholder' => 'Chọn ' . $model->getAttributeLabel('id_hang_bao_hanh')],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                        ],
                    ]);?>
                </div>
                <!-- <div class="col">
                    <?= $form->field($model, 'id_nhien_lieu')->textInput() ?>
                </div>-->
            </div>
            <div class="row">
            	<div class="col">
                    <?= $form->field($model, 'dac_tinh_ky_thuat')->textarea(['rows' => 5  ]) ?>
                </div>
            </div>
            </fieldset>
        </div>
        <!--Cột thứ 2-->
        <div class="col-5">
            <fieldset class="border p-2" style="margin:3px"><!--phụ trách -->
            <legend class="legend"><p>Phụ trách</p></legend>
            <div class="row">
                <div class="col">
                    
                    <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
                             'data' => (new BoPhan())->getListTree(),
                		     'options' => [
                		         'id'=>'id-bo-phan',
                		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan_quan_ly') .'...'
                		     ],
                		     'pluginOptions' => [
                		         'allowClear' => true,
                		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
                		     ],
                		 ]);
                	 ?>        
                </div>
                <div class="col">
                    <?= $form->field($model, 'id_nguoi_quan_ly')->widget(DepDrop::classname(), [
                            'options'=>[
                                'id'=>'id-nhan-vien',
                                'placeholder' => 'Select ...'
                            ],
                            'data' => ($model->isNewRecord 
                                        ? $newArr 
                                        :[$model->id_nguoi_quan_ly=>$model->tenNguoiQuanLy]),
                            'type'=>DepDrop::TYPE_SELECT2,
                            'select2Options'=>[
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                ],
                            ],
                            'pluginOptions'=>[
                                'depends'=>['id-bo-phan'],
                                //'initialize' => true,
                                'url'=>Url::to(['/kholuutru/depdrop/get-nhan-vien']),
                            ],
                        ]);
                   ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'id_don_vi_bao_tri')->widget(Select2::classname(), [
                             'data' => (new BoPhan())->getListTree(),
                		     'options' => [
                		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_don_vi_bao_tri') .'...'
                		     ],
                		     'pluginOptions' => [
                		         'allowClear' => true,
                		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
                		     ],
                		 ]);
                	 ?>   
                </div>
                <div class="col">
                <?= $form->field($model, 'id_trung_tam_chi_phi')->widget(Select2::classname(), [
                             'data' => (new BoPhan())->getListTree(),
                		     'options' => [
                		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_trung_tam_chi_phi') .'...'
                		     ],
                		     'pluginOptions' => [
                		         'allowClear' => true,
                		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
                		     ],
                		 ]);
                	 ?>   
                </div>
            </div>
            </fieldset><!--end phụ trách-->

            <fieldset class="border p-2" style="margin:3px"><!--Thời gian và trạng thái -->
            <legend class="legend"><p>Thời gian và trạng thái</p></legend>
            <div class="row">
                <div class="col">
               <?= $form->field($model, 'ngay_mua')->widget(DatePicker::classname(), [
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
                <div class="col">
                <?= $form->field($model, 'ngay_dua_vao_su_dung')->widget(DatePicker::classname(), [
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
                <div class="col">
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
                <div class="col">                
                <?= $form->field($model, 'ngay_ngung_hoat_dong')->widget(DatePicker::classname(), [
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
                
                <div class="mb-3 row field-loathietbi-trang_thai">
                	<div class="col-sm-4">
                    	<label class="col-md-12 control-label" for="loathietbi-trang_thai">
                    	<?= $model->getAttributeLabel('trang_thai') ?>
                    	</label>
                	</div>
                	<div class="col-sm-8">
                	<?= RadioWidget::widget([
                	    'model'=>$model,
                	    'attr'=>'trang_thai',
                	    'isNew'=>$model->isNewRecord,
                	    'showInline'=>true,
                    	'list'=>ThietBi::getDmTrangThai()
                	]) ?>
            		<div class="invalid-feedback "></div></div>
                </div>
    
            </div>
            
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 5  ]) ?>
                </div>
            </div>
            
            </fieldset><!--End thoi gian trang thai-->
            
           
        </div>
        <div class="col-2">
            <fieldset class="border p-2" style="margin:3px"><!--Tai lieu -->
                <div class="row">
                    <div class="row-10">
                    	<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Tài liệu</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		<?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải tài liệu lên':'Chọn file tài liệu.' ?>
                        	</p>
                        <?php // '<label class="form-label" style="font-weight:bold">Tài liệu</label>';?>
                        <?php if(!$model->isNewRecord): ?>
                            <?= DocumentWidget::widget([
                                'loai' => ThietBi::MODEL_ID,
                                'id_tham_chieu' => $model->id
                            ]) ?>
                            <?php endif; ?>
                         </div><!-- card-body -->
                    </div>
                </div>
            </fieldset>   
            <fieldset class="border p-2" style="margin:3px"><!--Hinh anh -->
                <div class="row">
                    <div class="row-10">
                    <div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Hình ảnh</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		<?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải ảnh lên':'Chọn file hình ảnh.' ?>
                        	</p>
                        <?php // '<label class="form-label" style="font-weight:bold">Hình ảnh</label>';?>
                        <?php if(!$model->isNewRecord): ?>
                                <?= ImageWidget::widget([
                                    'loai' => ThietBi::MODEL_ID,
                                    'id_tham_chieu' => $model->id
                                ]) ?>
                        <?php endif; ?>
                        </div><!-- card-body -->
                    </div>
                </div>
            </fieldset>              
        </div>
    </div>

        <?php ActiveForm::end(); ?>
</div>

   