<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\modules\dungchung\models\CustomFunc;
use app\modules\muasam\models\PhieuNhapHang;
use app\widgets\forms\DocumentWidget;
use app\widgets\forms\ImageWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuNhapHang */
/* @var $form yii\widgets\ActiveForm */
$cus = new CustomFunc();
if ($model->ngay_nhap_hang != null) {
    $model->ngay_nhap_hang = $cus->convertYMDToDMY($model->ngay_nhap_hang);
}

?>

<div class="phieu-nhap-hang-form">
    <div class="row">
        <div class="col-6">
            <fieldset class="border p-2" style="margin:3px;">
                <!--Thông tin chung -->
                <legend class="legend">
                    <p>Thông tin phiếu nhập hàng
                        <span
                            class="badge rounded-pill bg-<?= $model->getColorTrangThai()[$model->trang_thai] ?>"><?= $model->getDmTrangThai()[$model->trang_thai] ?></span>
                    </p>
                </legend>
                <?php $form = ActiveForm::begin([
        'action' => ['/muasam/phieu-nhap-hang/update','id'=>$model->id]
    ]); ?>
                <div class="row">

                    <div class="col-12">
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
            </fieldset>

        </div>
        <div class="col-6">
            <fieldset class="border p-2" style="margin:3px">
                <!--Tai lieu -->
                <div class="row">
                    <div class="col">
                        <div class="card-body pd-20 pd-md-40 shadow-none">
                            <h5 class="card-title mg-b-20">Tài liệu</h5>
                            <p class="text-muted card-sub-title mt-1">
                                <?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải tài liệu lên':'Chọn file tài liệu.' ?>
                            </p>
                            <?php // '<label class="form-label" style="font-weight:bold">Tài liệu</label>';?>
                            <?php if(!$model->isNewRecord): ?>
                            <?= DocumentWidget::widget([
                                'loai' => PhieuNhapHang::MODEL_ID,
                                'id_tham_chieu' => $model->id
                            ]) ?>
                            <?php endif; ?>
                        </div><!-- card-body -->
                    </div>
                    <div class="col">
                        <div class="card-body pd-20 pd-md-40 shadow-none">
                            <h5 class="card-title mg-b-20">Hình ảnh</h5>
                            <p class="text-muted card-sub-title mt-1">
                                <?= $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải ảnh lên':'Chọn file hình ảnh.' ?>
                            </p>
                            <?php // '<label class="form-label" style="font-weight:bold">Hình ảnh</label>';?>
                            <?php if(!$model->isNewRecord): ?>
                            <?= ImageWidget::widget([
                                    'loai' => PhieuNhapHang::MODEL_ID,
                                    'id_tham_chieu' => $model->id
                                ]) ?>
                            <?php endif; ?>
                        </div><!-- card-body -->
                    </div>
                </div>
            </fieldset>

        </div>
    </div>




















</div>