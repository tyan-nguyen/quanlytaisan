<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\muasam\models\BaoGiaMuaSam;
use app\widgets\forms\DocumentWidget;
use app\widgets\forms\ImageWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bao-gia-mua-sam-form">
    <div class="row">
        <div class="col-6">
            <fieldset class="border p-2" style="margin:3px;">
                <!--Thông tin chung -->
                <legend class="legend">
                    <p>Thông tin báo giá
                        <span
                            class="badge rounded-pill bg-<?= $model->getColorTrangThai()[$model->trang_thai] ?>"><?= $model->getDmTrangThai()[$model->trang_thai] ?></span>
                    </p>
                </legend>
                <?php $form = ActiveForm::begin([
        'action' => ['/muasam/bao-gia-mua-sam/update','id'=>$model->id]
    ]); ?>



                <?= $form->field($model, 'ghi_chu_bg1')->textarea(['rows' => 6]) ?>




                <?php if ($model->trang_thai=="draft"){ ?>
                <div class="form-group text-center">
                    <?= Html::a(' Gửi báo giá', null, [
					'class' => 'btn btn-success',
					'style'=>"margin-left:5px",
					'data' => [
						'method' => 'post',
						'params'=>['BaoGiaMuaSam[trang_thai]'=>'submited']
					]
				]);
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
                                'loai' => BaoGiaMuaSam::MODEL_ID,
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
                                    'loai' => BaoGiaMuaSam::MODEL_ID,
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