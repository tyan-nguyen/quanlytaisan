<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\dungchung\models\CustomFunc;
use kartik\date\DatePicker;
use app\modules\bophan\models\BoPhan;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\modules\bophan\models\NhanVien;
use app\modules\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuMuaSam */
/* @var $form yii\widgets\ActiveForm */

$cus = new CustomFunc();
if ($model->ngay_yeu_cau != null) {
    $model->ngay_yeu_cau = $cus->convertYMDToDMY($model->ngay_yeu_cau);
}
$action=['/muasam/phieu-mua-sam/create'];
if(!$model->isNewRecord)
$action=['/muasam/phieu-mua-sam/update','id'=>$model->id];

$newArr = [];
if($model->isNewRecord){
    if($model->id_nguoi_quan_ly != null){
        $nv = NhanVien::findOne($model->id_nguoi_quan_ly);
        if($nv != null){
            $newArr = [$model->id_nguoi_quan_ly => $nv->ten_nhan_vien];
        }
    }
}

$permissionCheck=User::hasPermission("qDuyetPhieuMuaSam");
$isDuyet=$permissionCheck && $model->trang_thai==='submited';


// Display success flash message
if (Yii::$app->session->hasFlash('success')) {
    echo '<div class="alert alert-success">' . Yii::$app->session->getFlash('success') . '</div>';
}
// Display error flash message
if (Yii::$app->session->hasFlash('error')) {
    echo '<div class="alert alert-danger">' . Yii::$app->session->getFlash('error') . '</div>';
}
?>

<div class="phieu-mua-sam-form">

    <?php $form = ActiveForm::begin([
        'action' => $action
    ]); ?>
    <div class='row'>
        <div class="col">
            <?= $form->field($model, 'id_bo_phan_quan_ly')->widget(Select2::classname(), [
                             'data' => (new BoPhan())->getListTree(),
                		     'options' => [
                		         'id'=>'id-bo-phan',
                		         'placeholder' => 'Chọn '. $model->getAttributeLabel('id_bo_phan_quan_ly') .'...'
                		     ],
                		     'pluginOptions' => [
                		         'allowClear' => true,
                                 'width' => '100%',
                		         'dropdownParent' => $model->isNewRecord ? new yii\web\JsExpression('$("#ajaxCrudModal")') : null, 
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
                                    'width' => '100%',
                                    'dropdownParent' => $model->isNewRecord ? new yii\web\JsExpression('$("#ajaxCrudModal")') : null,
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
        
        <?php if(!$model->isNewRecord) { ?>
        <div class='col'>
            <label class="control-label">Trạng thái</label>
            <br />
            <span
                class="badge rounded-pill bg-<?= $model->getColorTrangThai()[$model->trang_thai] ?>"><?= $model->getDmTrangThai()[$model->trang_thai] ?></span>
        </div>
        <?php } ?>
        



    </div>
    <div class='row'>

        <div class="col">
        
            <?=$form->field($model, 'id_tt_mua_sam')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(BoPhan::find()->where(['la_dv_mua_hang'=>1])->all(), 'id', 'ten_bo_phan'),
                                    'language' => 'vi',
                                    'options' => [
                                        'placeholder' => 'Chọn trung tâm mua sắm...'
                                        
                                    ],
                                    'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%',
                    'dropdownParent' => Yii::$app->request->isAjax ? new yii\web\JsExpression('$("#ajaxCrudModal")') : null,
                ],
            ]);?>
        </div>
        <div class="col">
            <?=$form->field($model, 'ngay_yeu_cau')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Chọn ngày...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true,
                'todayBtn' => true,
            ],
        ]);?>

        </div>

    </div>
    <div class='row'>
        <div class="col">
        <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 4]) ?>
        </div>
        <?php if(!$model->isNewRecord) { ?>
        <div class="col">
        <?= $form->field($model, 'ghi_chu_duyet')->textarea(['rows' => 4,'disabled'=> $isDuyet ? false :'disabled' ]) ?>
        </div>
        <?php } ?>
    </div>

    <?= $form->field($model, 'dm_mua_sam')->textInput(['hidden' => 'hidden'])->label(false) ?>

    <?php if (!in_array($model->trang_thai,['rejected','completed'])){ ?>
    <div class="form-group text-center">
        <?= $model->trang_thai==='draft' ? Html::a('Gửi yêu cầu', null, [
					'class' => 'btn btn-success',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>[
                            'PhieuMuaSam[trang_thai]'=>'submited',
                            'messageSuccess'=>'Gửi yêu cầu thành công',
                            'messageError'=>'Gửi yêu cầu thất bại'
                            ]
                    ],
                    'data-confirm' => 'Bạn có chắc muốn gửi báo giá',
                    //'title' => Yii::t('yii', 'NDel'),
                    'data-confirm-title'=>'',
                    'data-confirm-message'=>''
				]) : '';
			?>
            
        <?= $permissionCheck && $model->trang_thai==='submited' ? Html::a('Duyệt yêu cầu', null, [
					'class' => 'btn btn-primary',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>['PhieuMuaSam[trang_thai]'=>'approved'],
                        'messageSuccess'=>'Duyệt yêu cầu thành công',
                        'messageError'=>'Duyệt yêu cầu thất bại'
                    ],
                    'data-confirm' => 'Bạn có chắc muốn duyệt báo giá',
				]) : '';
			?>
        <?= $permissionCheck && $model->trang_thai==='submited' ? Html::a('Từ chối', null, [
					'class' => 'btn btn-danger',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>['PhieuMuaSam[trang_thai]'=>'rejected'],
                        'messageSuccess'=>'Từ chối yêu cầu thành công',
                        'messageError'=>'Từ chối yêu cầu thất bại'
                    ],
                    'data-confirm' => 'Bạn có chắc muốn từ chối báo giá',
				]) :'';
			?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>