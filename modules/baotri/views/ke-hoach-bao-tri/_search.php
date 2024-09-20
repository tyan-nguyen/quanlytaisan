<?php
use app\modules\baotri\models\LoaiBaoTri;
use app\modules\bophan\models\NhanVien;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\ThietBi;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\KeHoachBaoTri */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ke-hoach-bao-tri-search">
	<?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>
	<div class="row">
		<div class="col-6">
          <?= $form->field($model, 'id_he_thong')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(HeThong::find()->all(), 'id', 'ten_he_thong'),
                    'language' => 'vi',
                    'options' => [
                        'id'=>'id-he-thong-search', 
                        'placeholder' => 'Chọn hệ thống...',
                        'data-dropdown-parent'=>"#offcanvasRight"
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                       // 'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                    ],
            ]);?>
		</div>
		<div class="col-6">
			  <?php /* $form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(ThietBi::find()->all(), 'id', 'ten_thiet_bi'),
                    'language' => 'vi',
                    'options' => [
                        'placeholder' => 'Chọn thiết bị...',
                        'data-dropdown-parent'=>"#offcanvasRight"
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                    ],
                ]); */ ?>
                <label>Thiết bị</label>
                <?= $form->field($model, 'id_thiet_bi')->widget(DepDrop::classname(), [
                        'options'=>[
                            'id'=>'id-thiet-bi-search',
                            'placeholder' => 'Select ...'
                        ],
                        'data' => (ArrayHelper::map(ThietBi::find()->all(), 'id', 'ten_thiet_bi')),
                        'type'=>DepDrop::TYPE_SELECT2,
                        'select2Options'=>[
                            'pluginOptions' => [
                                'allowClear' => true,
                                'dropdownParent' => '#offcanvasRight',
                            ],
                        ],
                        'pluginOptions'=>[
                            'depends'=>['id-he-thong-search'],
                            //'initialize' => true,
                            'url'=>Url::to(['/taisan/ajax/get-tai-san-by-he-thong']),
                        ],
                    ])->label('');
               ?>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<?= $form->field($model, 'ten_cong_viec')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			  <?= $form->field($model, 'id_loai_bao_tri')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(LoaiBaoTri::find()->all(), 'id', 'ten'),
                    'language' => 'vi',
                    'options' => [
                        'placeholder' => 'Loại bảo trì...',
                        'data-dropdown-parent'=>"#offcanvasRight"
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        //'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                    ],
                ]);?>
		</div>
		<div class="col-6">
			   <?= $form->field($model, 'muc_do_uu_tien')->widget(Select2::classname(), [
                        'data' => ["0"=> "Không ưu tiên", "1"=>"Ưu tiên", "2"=>"Xử lý gấp"],
                        'language' => 'vi',
                        'options' => [
                            'placeholder' => 'Chọn đơn mức độ ưu tiên...',
                            'data-dropdown-parent'=>"#offcanvasRight"
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                           // 'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                        ],
                ]);?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-6">
			<?php // '<label class="form-label">Ngày hết hiệu lực</label>';?>
			<?php /* DatePicker::widget([
                    'name' => 'ngay_het_hieu_luc', 
                    'value' => '',
                    'options' => ['placeholder' => 'Chọn ngày ....'],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pickerIcon' => '<i class="fas fa-calendar-alt text-infor"></i>',
                    'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy',
                        'todayHighlight' => true
                    ]
                ]);*/
            ?>
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
		<div class="col-6">
				<?= $form->field($model, 'id_nguoi_chiu_trach_nhiem')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                'language' => 'vi',
                'options' => [
                    'placeholder' => 'Chọn người chịu trách nhiệm ...',
                    'data-dropdown-parent'=>"#offcanvasRight"
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);?>
		</div>
    </div>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
