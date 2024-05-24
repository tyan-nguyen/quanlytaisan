<?php
use app\modules\bophan\models\BoPhan;
use app\modules\bophan\models\DoiTac;
use app\modules\bophan\models\NhanVien;
use app\modules\dungchung\models\CustomFunc;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\taisan\models\ThietBi;
use app\modules\taisan\models\ViTri;
use app\widgets\forms\DocumentWidget;
use app\widgets\forms\ImageWidget;
use app\widgets\forms\RadioWidget;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

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
                ?>

<style>    
    .modal-body{
        padding: 10px 0px;
    }
</style>

<div class="ts-thiet-bi-form container-fluid formInput">
    <?php $form = ActiveForm::begin([
        'id'=>'frm-ts',
        //'layout' => 'vertical',
        'options' => [
         //   'class' => 'form-vertical',
        ],
        'fieldConfig' => [
            //'template' => '<div class="col-sm-3">{label}</div><div class="col-sm-9">{input}{error}</div>',
           // 'labelOptions' => ['class' => 'col-md-12 control-label'],
        ],
    ]); ?>

    <div class="row"><!-- row 1 -->
    	<div class="col-md-12">
    		<div class="card custom-card">
        		<div class="row"><!-- row 2 -->
            		<div class="col-md-5">
            			<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Thông tin chung</h5>
                        	<div class="row">
                            	<div class="col-md-4">
                            	<?= $form->field($model, 'ma_thiet_bi')->textInput(['maxlength' => true]) ?>
                            	</div>
                            	<div class="col-md-8">
                            	<?= $form->field($model, 'ten_thiet_bi')->textInput(['maxlength' => true]) ?>
                            	</div>
                        	</div>
                        	<div class="row">
                            	<div class="col-md-6">
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
                                <div class="col-md-6">                                
                                <?= $form->field($model, 'id_thiet_bi_cha')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(ThietBi::find()->all(), 'id', 'ten_thiet_bi'),
                                    'language' => 'vi',
                                    'options' => ['placeholder' => 'Chọn thiết bị...', 'class'=>'form-control'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);?>
                                </div>
                            </div>
                            <?= $form->field($model, 'id_he_thong')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(HeThong::find()->all(), 'id', 'ten_he_thong'),
                                'language' => 'vi',
                                'options' => ['placeholder' => 'Chọn hệ thống...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                ],
                            ]);?>
                            <?= $form->field($model, 'id_vi_tri')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(ViTri::find()->all(), 'id', 'ten_vi_tri'),
                                'language' => 'vi',
                                'options' => ['placeholder' => 'Chọn vị trí...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                ],
                            ]);?>
                       	</div><!-- card body -->
                    </div><!-- col-md-5 --> 
                    
                    <div class="col-md-5">
                    	<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Phụ trách</h5>
                        	
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
    			</div><!-- row2 -->
    			
    			
    			
    		</div><!-- card -->
    	</div><!-- col-md-12 -->
    	
    	
    	<div class="col-md-12">
    		<div class="card custom-card">
    		<div class="row"><!-- row 2 -->
        			<div class="col-md-5">
            			<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Thông tin kỹ thuật</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		Thông tin kỹ thuật
                        	</p>
                        	<?= $form->field($model, 'nam_san_xuat')->textInput(['maxlength' => true]) ?>
                        	<?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>
                        	<?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
                        	<?= $form->field($model, 'xuat_xu')->textInput(['maxlength' => true]) ?>
                        	<?= $form->field($model, 'id_hang_bao_hanh')->widget(Select2::classname(), [
                                'data' => DoiTac::getHangBaoHanhList(),
                                'options' => ['placeholder' => 'Chọn ' . $model->getAttributeLabel('id_hang_bao_hanh')],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                                ],
                            ]);?>
                            <?= $form->field($model, 'dac_tinh_ky_thuat')->textarea(['rows' => 5  ]) ?>
                      
                       	</div><!-- card body -->
                	</div><!-- col-md-5 -->    
                	
                	 <div class="col-md-7">
                    	<div class="card-body pd-20 pd-md-40 shadow-none">
                        	<h5 class="card-title mg-b-20">Thời gian và trạng thái</h5>
                        	<p class="text-muted card-sub-title mt-1">
                        		Thời gian và trạng thái
                        	</p>
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
                        	
                        	<?= $form->field($model, 'ghi_chu')->textarea(['rows' => 5  ]) ?>
                
                     	</div><!-- card-body --> 
                    </div>  <!-- col-md-7 --> 	
                        		
             </div>
			</div><!-- row2 -->
    	</div>
    	
        
        
        
    </div><!-- row1 -->
        <?php ActiveForm::end(); ?>
</div>

   