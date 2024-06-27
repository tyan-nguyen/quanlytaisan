<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\widgets\forms\DocumentWidget;
use app\modules\baotri\models\PhieuBaoTri;
use yii\helpers\ArrayHelper;
use app\modules\bophan\models\BoPhan;
use kartik\select2\Select2;
use app\modules\bophan\models\NhanVien;
use app\widgets\forms\SwitchWidget;
use app\modules\dungchung\models\CustomFunc;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\PhieuBaoTri */
/* @var $form yii\widgets\ActiveForm */

$cus = new CustomFunc();
if($model->thoi_gian_bat_dau != null)
    $model->thoi_gian_bat_dau = $cus->convertYMDHISToDMY($model->thoi_gian_bat_dau);
if($model->thoi_gian_ket_thuc != null)
    $model->thoi_gian_ket_thuc = $cus->convertYMDHISToDMY($model->thoi_gian_ket_thuc);
    
?>

<div class="phieu-bao-tri-form  container-fluid formInput">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => '<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-md-12 control-label'],
        ],
    ]); ?>
    
     <div class="row">
    	<div class="col-md-12">
        	<div class="card custom-card">
        		<div class="row">
        			<div class="col-md-6">
            			<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Thông tin Phiếu bảo trì</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		Phiếu được tạo từ Kế hoạch bảo trì #<?= $model->id_ke_hoach ?>
                        	</p>
                        	
                        	<?= $form->field($model, 'ky_thu')->textInput() ?>
                            
                            <?= $form->field($model, 'id_don_vi_bao_tri')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(BoPhan::find()->all(), 'id', 'ten_bo_phan'),
                                    'language' => 'vi',
                                    'options' => ['placeholder' => 'Chọn đơn vị bảo trì...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                    ],
                                ]);?>
                            
                            <?= $form->field($model, 'id_nguoi_chiu_trach_nhiem')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                                    'language' => 'vi',
                                    'options' => ['placeholder' => 'Chọn người chịu trách nhiệm ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                    ],
                                ]);?>
    
                        </div><!-- card-body -->
					</div><!-- col-md-6 -->
					<div class="col-md-6">
            			<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Thông tin thực hiện</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		Vui lòng chọn thời gian hoàn thành và nhập nội dung thực hiện để xác nhận hoàn thành công việc bảo trì
                        	</p>
                        	
						  <?= $form->field($model, 'thoi_gian_bat_dau')->widget(DatePicker::classname(), [
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
						  <?= $form->field($model, 'thoi_gian_ket_thuc')->widget(DatePicker::classname(), [
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

                        
                            <?= $form->field($model, 'noi_dung_thuc_hien')->textarea(['rows' => 6]) ?>
                            
                            <?= SwitchWidget::widget([
                        	    'model'=>$model,
                        	    'attr'=>'da_hoan_thanh'
                        	]) ?>
    
                        </div><!-- card-body -->
					</div><!-- col-md-6 -->
        		</div>
        	</div>
        </div>
    </div>

<?php /* ?>
    <?= $form->field($model, 'id_ke_hoach')->textInput() ?>

    <?= $form->field($model, 'ky_thu')->textInput() ?>

    <?= $form->field($model, 'id_don_vi_bao_tri')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_chiu_trach_nhiem')->textInput() ?>

    <?= $form->field($model, 'thoi_gian_bat_dau')->textInput() ?>

    <?= $form->field($model, 'thoi_gian_ket_thuc')->textInput() ?>

    <?= $form->field($model, 'noi_dung_thuc_hien')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thoi_gian_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>
<?php */ ?>   
    <div class="col-12">
		  <?= '<label class="form-label" style="font-weight:bold">Tài liệu</label>';?>
        <?php if(!$model->isNewRecord): ?>
            <?= DocumentWidget::widget([
                'loai' => PhieuBaoTri::MODEL_ID,
                'id_tham_chieu' => $model->id
            ]) ?>
        <?php endif; ?>
	</div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
