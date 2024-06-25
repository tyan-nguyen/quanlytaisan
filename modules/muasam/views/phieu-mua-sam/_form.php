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
        <div class='col'>
            <?=$form->field($model, 'ngay_yeu_cau')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Chọn ngày...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
            ],
        ]);?>
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

        <div class='col-12'><?= $form->field($model, 'ghi_chu')->textarea(['rows' => 4]) ?></div>
    </div>



    <?php if (!in_array($model->trang_thai,['rejected','completed'])){ ?>
    <div class="form-group text-center">
        <?= $model->trang_thai==='draft' ? Html::a('Gửi yêu cầu', null, [
					'class' => 'btn btn-success',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>['PhieuMuaSam[trang_thai]'=>'submited']
					]
				]) : '';
			?>
        <?= $model->trang_thai==='submited' ? Html::a('Duyệt yêu cầu', null, [
					'class' => 'btn btn-primary',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>['PhieuMuaSam[trang_thai]'=>'approved']
					]
				]) : '';
			?>
        <?= $model->trang_thai==='submited' ? Html::a('Từ chối', null, [
					'class' => 'btn btn-danger',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>['PhieuMuaSam[trang_thai]'=>'rejected']
					]
				]) :'';
			?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>