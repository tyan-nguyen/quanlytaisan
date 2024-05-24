<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\widgets\forms\SwitchWidget;
use app\widgets\forms\RadioWidget;
use app\modules\bophan\models\BoPhan;
use app\modules\user\models\User;
use app\modules\dungchung\models\CustomFunc;
use app\modules\bophan\models\NhanVien;
use kartik\date\DatePicker;
use app\widgets\forms\ImageWidget;
use app\widgets\forms\DocumentWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\NhanVien */
/* @var $form yii\widgets\ActiveForm */

$cus = new CustomFunc();
if($model->ngay_vao_lam != null){
    $model->ngay_vao_lam = $cus->convertYMDToDMY($model->ngay_vao_lam);
}
if($model->ngay_thoi_viec != null){
    $model->ngay_thoi_viec = $cus->convertYMDToDMY($model->ngay_thoi_viec);
}
?>

<div class="bo-phan-form container-fluid formInput">

    <?php $form = ActiveForm::begin([
        'id'=>'frm-nv',
        'layout' => 'horizontal',
        'options' => [
            'class' => 'form-horizontal',
            //'data-pjax' => true
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
            		<div class="col-md-4">
            			<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Thông tin nhân viên</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		Thông tin nhân viên
                        	</p>
   	
                            <?= $form->field($model, 'ten_nhan_vien')->textInput(['maxlength' => true]) ?>
                        
                            <?= $form->field($model, 'ngay_sinh')->textInput(['maxlength' => true]) ?>
							
							<div class="mb-3 row field-nhanvien-gioi_tinh">
                            	<div class="col-sm-4"><label class="col-md-12 control-label" for="nhanvien-gioi_tinh"><?= $model->getAttributeLabel('gioi_tinh') ?></label></div>
                            	<div class="col-sm-8">
                            	<?= RadioWidget::widget([
                            	    'model'=>$model,
                            	    'attr'=>'gioi_tinh',
                                	'list'=>NhanVien::getDmGioiTinh()
                            	]) ?>
                        	<div class="invalid-feedback "></div></div>
                            </div>
                                            
                            <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true]) ?>
                        
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        
                            <?= $form->field($model, 'dia_chi')->textarea(['rows' => 6]) ?>
                    	</div><!-- card-body -->
					</div><!-- col-md-6 -->
					
					<div class="col-md-5">
            			<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Thông tin cấu hình</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		Chọn thông tin cấu hình cho nhân viên.
                        	</p>
                        	
                        	<?= $form->field($model, 'ma_nhan_vien')->textInput(['maxlength' => true]) ?>
                        	
                        	<?= $form->field($model, 'ngay_vao_lam')->widget(DatePicker::classname(), [
                                        'options' => [
                                            'placeholder' => 'Chọn ngày...'
                                        ],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ]
                        	   ]);
                        	?>
                        	 
                        	<?= $form->field($model, 'id_bo_phan')->widget(Select2::classname(), [
                                     'data' => (new BoPhan())->getListTree(),
                        		     'options' => ['placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan') .'...'],
                        		     'pluginOptions' => [
                        		         'allowClear' => true,
                        		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
                        		     ],
                        		 ]);
                        	 ?> 
                        	 
                        	 <?= $form->field($model, 'chuc_vu')->textInput(['maxlength' => true]) ?>                          
                        
                             <?= $form->field($model, 'ten_truy_cap')->widget(Select2::classname(), [
                                     'data' => (new User())->getListUnused($model->ten_truy_cap),
                        		     'options' => ['placeholder' => 'Chọn '. $model->getAttributeLabel('ten_truy_cap') .'...'],
                        		     'pluginOptions' => [
                        		         'allowClear' => true,
                        		         'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'), 
                        		     ],
                        		 ]);
                        	 ?>  
                        	                        	
                        	<div class="mb-3 row field-nhanvien-ma_nhan_vien">
                            	<div class="col-sm-4"><label class="col-md-12 control-label" for="nhanvien-da_thoi_viec"></label></div>
                            	<div class="col-sm-8"><?= SwitchWidget::widget([
                            	    'model'=>$model,
                            	    'attr'=>'da_thoi_viec'
                            	]) ?><div class="invalid-feedback "></div></div>
                            </div>
                            
                            <div id="dNgayThoiViec" <?= $model->da_thoi_viec==0?' style="display:none"': '' ?> >
                            <?= $form->field($model, 'ngay_thoi_viec')->widget(DatePicker::classname(), [
                                        'options' => [
                                            'placeholder' => 'Chọn ngày...',
                                            'id'=>'txtNgayThoiViec'
                                        ],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'dd/mm/yyyy'
                                        ] ]);
                        	?>
                        	</div>
                             
                    	</div><!-- card-body -->
					</div><!-- col-md-6 -->
					
					<div class="col-md-3">
            			<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Hình ảnh</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		<?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải ảnh lên':'Chọn file hình ảnh.' ?>
                        	</p>
                        	
                        	<?php if(!$model->isNewRecord): ?>
                            
                            <?= ImageWidget::widget([
                                'loai' => NhanVien::MODEL_ID,
                                'id_tham_chieu' => $model->id
                            ]) ?>
                            
                            <?php endif; ?>
                            
                        	</div><!-- card-body -->
                        	
                        	<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Tài liệu</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		<?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải tài liệu lên':'Chọn file tài liệu.' ?>
                        	</p>
                        	
                        	<?php if(!$model->isNewRecord): ?>
                            
                            <?= DocumentWidget::widget([
                                'loai' => NhanVien::MODEL_ID,
                                'id_tham_chieu' => $model->id
                            ]) ?>
                            
                            <?php endif; ?>
                            
                        	</div><!-- card-body -->
					</div><!-- col-md-6 -->
					
					<div class="col-md-6">
					</div><!-- col-md-6 -->
				</div><!-- row 2 -->
			</div><!-- card -->
		</div><!-- col-md-12 -->
    </div><!-- row -->

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>


<script>
$('input[name="NhanVien[da_thoi_viec]"]').change(function () {
    if(this.checked){
    	$('#dNgayThoiViec').show();
    } else {
    	$('#dNgayThoiViec').hide();
    }
});
</script>