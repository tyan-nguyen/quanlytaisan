<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\widgets\forms\RadioWidget;
use app\modules\suachua\models\BaoGiaSuaChua;
use app\widgets\forms\DocumentWidget;
use app\widgets\forms\ImageWidget;
use kartik\select2\Select2;
use app\modules\bophan\models\DoiTac;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\BaoGiaSuaChua */
/* @var $form yii\widgets\ActiveForm */

$isCheckUpdate=$phieuSuaChua->trang_thai !== 'completed';
?>

<div class="bao-gia-sua-chua-form">
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
        'action' => ['/suachua/bao-gia-sua-chua/update','id'=>$model->id]
    ]); ?>
                




                <?php if ($isCheckUpdate && $model->trang_thai ==='draft'){ ?>
                <div class="form-group text-center">
                    <?= Html::a(' Gửi báo giá', null, [
                'class' => 'btn btn-success',
                'style'=>"margin-left:5px",
                'data' => [
                    'method' => 'post',
                    'params'=>['BaoGiaSuaChua[trang_thai]'=>'submited']
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
                                'loai' => BaoGiaSuaChua::MODEL_ID,
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
                                    'loai' => BaoGiaSuaChua::MODEL_ID,
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