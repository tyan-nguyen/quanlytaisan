<?php
use app\modules\baotri\models\LoaiBaoTri;
use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\ThietBi;
use app\widgets\forms\DocumentWidget;
use app\widgets\forms\SwitchWidget;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\modules\baotri\models\KeHoachBaoTri;
use app\modules\dungchung\models\CustomFunc;

/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\KeHoachBaoTri */
/* @var $form yii\widgets\ActiveForm */
$cus = new CustomFunc();
if($model->ngay_thuc_hien != null)
    $model->ngay_thuc_hien = $cus->convertYMDToDMY($model->ngay_thuc_hien);
if($model->ngay_bao_tri_cuoi != null)
    $model->ngay_bao_tri_cuoi = $cus->convertYMDToDMY($model->ngay_bao_tri_cuoi);
if($model->ngay_het_hieu_luc != null)
    $model->ngay_het_hieu_luc = $cus->convertYMDToDMY($model->ngay_het_hieu_luc);
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
<div class="ke-hoach-bao-tri-form">
	    <?php $form = ActiveForm::begin( ['options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '<div class="col-sm-12">{label}</div><div class="col-sm-12">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-md-12 control-label'],
            ],
        ]); ?>
        <?= $form->errorSummary($model) ?>
	<div class="ts-thiet-bi-form">
        <div class="card custom-card">
        	<div class="card-body shadow-none">
        		 <div class="row">
                	<div class="col-5">
                        <fieldset class="border p-2" style="margin:3px;"><!--Thông tin chung -->
                        <legend class="legend"><p>Thông tin chung</p></legend>
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
                                  <?= $form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(ThietBi::find()->all(), 'id', 'ten_thiet_bi'),
                                    'language' => 'vi',
                                    'options' => ['placeholder' => 'Chọn thiết bị...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                    ],
                                ]);?>
                            </div>
                        </div>
                        <div class="row">
                         	<div class="col">
                                <?= $form->field($model, 'ten_cong_viec')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                         <div class="row">
                         	<!-- <div class="col">
                         		 <?= $form->field($model, 'id_chi_tiet')->textInput() ?>
                            </div>  -->
                            <div class="col">
                                <?= $form->field($model, 'id_loai_bao_tri')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(LoaiBaoTri::find()->all(), 'id', 'ten'),
                                    'language' => 'vi',
                                    'options' => ['placeholder' => 'Loại bảo trì...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                    ],
                                ]);?>
                            </div>
                        </div>
                         <div class="row">
                         	<div class="col">
                                  <div class="col">
								  <?= $form->field($model, 'ngay_bao_tri_cuoi')->widget(DatePicker::classname(), [
                                            'options' => [
                                                'placeholder' => 'Chọn ngày...'
                                            ],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd/mm/yyyy',
                                                'todayHighlight' => true
                                            ]
                            	   ]);
                	               ?>
                            </div>
                            </div>
                            <div class="col">
                                   <?= $form->field($model, 'bao_truoc')->textInput() ?>
                            </div>
                        </div>
                        <div class="row">
                         	<div class="col">
                                   <?= $form->field($model, 'can_cu')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col">
                                    <?= $form->field($model, 'so_ky')->textInput() ?>
                            </div>
                        </div>
                        <div class="row">
                        	  <div class="col">
                                   <?= $form->field($model, 'id_don_vi_bao_tri')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(BoPhan::find()->all(), 'id', 'ten_bo_phan'),
                                    'language' => 'vi',
                                    'options' => ['placeholder' => 'Chọn đơn vị bảo trì...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                    ],
                                ]);?>
                            </div>
                             <div class="col">
								  <?= $form->field($model, 'ngay_thuc_hien')->widget(DatePicker::classname(), [
                                            'options' => [
                                                'placeholder' => 'Chọn ngày...'
                                            ],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd/mm/yyyy',
                                                'todayHighlight' => true
                                            ]
                            	   ]);
                	               ?>
                            </div>
                        </div>
                	</div>
                	
                	<div class="col-5">
                        <fieldset class="border p-2" style="margin:3px;"><!--Thông tin chung -->
                        <legend class="legend"><p>Người và thời gian thực hiện </p></legend>
                         <div class="row">
                         	<div class="col">
                                 <?= $form->field($model, 'ky_bao_tri')->dropDownList(
                                        ['1'=>'Ngày', '2'=>'Tuần', '3'=>'Tháng', '4'=>'Năm'],           // Flat array ('id'=>'label')
                                        ['prompt'=>'']    // options
                                    );
                                ?>
                            </div>
                            	<div class="col">
                                 
                                       <?= $form->field($model, 'muc_do_uu_tien')->widget(Select2::classname(), [
                                        'data' => ["0"=> "Không ưu tiên", "1"=>"Ưu tiên", "2"=>"Xử lý gấp"],
                                        'language' => 'vi',
                                        'options' => ['placeholder' => 'Chọn đơn mức độ ưu tiên...'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                        ],
                                ]);?>
                                 
                            </div>
                        </div>
                         <div class="row">
                         
                            <div class="col">
                                <?= $form->field($model, 'truc_thuoc')->textInput() ?>                                   
                            </div>
                        </div>
                         <div class="row">
                         	<div class="col">
                                   <?= $form->field($model, 'thoi_gian_thuc_hien')->textInput() ?>
                            </div>
                            <div class="col">
                                   <?= $form->field($model, 'don_vi_thoi_gian')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="row">
                         	<div class="col">
                                    <?= SwitchWidget::widget([
                                	    'model'=>$model,
                                	    'attr'=>'dung_may'
                                	]) ?>
                            </div>
                            <div class="col">
                                     <?= SwitchWidget::widget([
                                	    'model'=>$model,
                                	    'attr'=>'thue_ngoai'
                                	]) ?>
                            </div>
                        </div>
                         <div class="row">
                         	<div class="col">
                                   <?= SwitchWidget::widget([
                                	    'model'=>$model,
                                	    'attr'=>'da_het_hieu_luc'
                                	]) ?>
                            </div>
                            <div class="col">
                            	 <div id="dNgayHetHieuLuc" <?= $model->da_het_hieu_luc==0?' style="display:none"': '' ?> >
                            		  <?= $form->field($model, 'ngay_het_hieu_luc')->widget(DatePicker::classname(), [
                                            'options' => [
                                                'placeholder' => 'Chọn ngày...'
                                            ],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd/mm/yyyy',
                                                'todayHighlight' => true
                                            ]
                            	   ]);
                	               ?>
                            	</div>
                            </div>
                        </div>
                         <div class="row">
                         	<div class="col">
                         		<?= $form->field($model, 'id_nguoi_chiu_trach_nhiem')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                                    'language' => 'vi',
                                    'options' => ['placeholder' => 'Chọn người chịu trách nhiệm ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                    ],
                                ]);?>
                         	
                         	</div>
                         </div>
                         </fieldset>
                	</div>
                	<div class="col-2">
                		  <?= '<label class="form-label" style="font-weight:bold">Tài liệu</label>';?>
                        <?php if(!$model->isNewRecord): ?>
                            <?= DocumentWidget::widget([
                                'loai' => KeHoachBaoTri::MODEL_ID,
                                'id_tham_chieu' => $model->id
                            ]) ?>
                        <?php endif; ?>
                	</div>
                </div>
        </div>
   </div>
    
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">

	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
</div>
</div>
<script>
$('input[name="KeHoachBaoTri[da_het_hieu_luc]"]').change(function () {
    if(this.checked){
    	$('#dNgayHetHieuLuc').show();
    } else {
    	$('#dNgayHetHieuLuc').hide();
    }
});
</script>
