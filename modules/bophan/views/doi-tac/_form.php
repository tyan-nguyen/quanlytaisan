<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\widgets\forms\SwitchWidget;
use app\modules\bophan\models\NhomDoiTac;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\DoiTac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doi-tac-form container-fluid formInput">

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
                            	<h5 class="card-title mg-b-20">Thông tin bộ phận</h5>
                            	<p class="text-muted card-sub-title mt-1">
                            		
                            	</p>
                                <?= $form->field($model, 'ma_doi_tac')->textInput(['maxlength' => true]) ?>
                            
                                <?= $form->field($model, 'ten_doi_tac')->textInput(['maxlength' => true]) ?>
                            
                                <?= $form->field($model, 'id_nhom_doi_tac')->dropDownList(NhomDoiTac::getList(), ['prompt'=>'--Chọn nhóm đối tác--']) ?>
                            
                                <?= $form->field($model, 'dia_chi')->textarea(['rows' => 3]) ?>
                            
                                <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true]) ?>
                            
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    					</div>
    				</div>
    				
    				<div class="col-md-6">
                        	<div class="card-body pd-20 pd-md-40 shadow-none">
                            	<h5 class="card-title mg-b-20">Thông tin bộ phận</h5>
                            	<p class="text-muted card-sub-title mt-1">
                            		
                            	</p>
                              	<?= $form->field($model, 'tai_khoan_ngan_hang')->textInput(['maxlength' => true]) ?>
                            
                                <?= $form->field($model, 'ma_so_thue')->textInput(['maxlength' => true]) ?>
                                
                                <?= SwitchWidget::widget([
                            	    'model'=>$model,
                            	    'attr'=>'la_nha_cung_cap'
                            	]) ?>
                            	
                            	<?= SwitchWidget::widget([
                            	    'model'=>$model,
                            	    'attr'=>'la_khach_hang'
                            	]) ?>

    					</div>
    				</div>
    			</div>
    		</div>
    	</div><!-- col-md-12 -->
    </div><!-- row -->

    <?php ActiveForm::end(); ?>
    
</div>
