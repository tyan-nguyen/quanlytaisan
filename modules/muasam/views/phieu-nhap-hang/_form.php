<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuNhapHang */
/* @var $form yii\widgets\ActiveForm */
$cus = new CustomFunc();
if ($model->ngay_nhap_hang != null) {
    $model->ngay_nhap_hang = $cus->convertYMDToDMY($model->ngay_nhap_hang);
}

?>

<div class="phieu-nhap-hang-form">

    <?php $form = ActiveForm::begin([
        'action' => ['/muasam/phieu-nhap-hang/update','id'=>$model->id]
    ]); ?>
    <div class="row">

        <div class="col-6">
            <?= $form->field($model, 'ngay_nhap_hang')->widget(DatePicker::classname(), [
                                'options' => [
                                    'placeholder' => 'Chọn ngày...'
                                ],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd/mm/yyyy'
                                ]
                	   ]); ?>
        </div>
        <div class='col-6'>
            <label class="control-label">Trạng thái</label>
            <br />
            <span
                class="badge rounded-pill bg-<?= $model->getColorTrangThai()[$model->trang_thai] ?>"><?= $model->getDmTrangThai()[$model->trang_thai] ?></span>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group text-center">
        <?= $model->trang_thai==='draft' ? Html::a('Hoàn thành', null, [
					'class' => 'btn btn-success',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>['PhieuNhapHang[trang_thai]'=>'completed']
					]
				]) : "";
			?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>