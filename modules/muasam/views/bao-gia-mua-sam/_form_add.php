<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\bophan\models\DoiTac;
use yii\helpers\ArrayHelper;
use app\modules\muasam\models\BaoGiaMuaSam;
use app\widgets\forms\DocumentWidget;
use app\widgets\forms\ImageWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
/* @var $form yii\widgets\ActiveForm */
$actionBG=['/muasam/bao-gia-mua-sam/create','id_phieu_mua_sam'=>$model->id_phieu_mua_sam];
if(!$model->isNewRecord)
$actionBG=['/muasam/bao-gia-mua-sam/update-content','id'=>$model->id];;
?>

<div class="bao-gia-mua-sam-form">

    <?php $form = ActiveForm::begin([
        'id' => 'your-model-form-bao-gia',
        'action' => $actionBG,
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>


    <div class="row">
        <div class="col-12">
            <?=$form->field($model, 'id_dv_bao_gia')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(DoiTac::find()->all(), 'id', 'ten_doi_tac'),
                        'language' => 'vi',
                        'options' => [
                            'placeholder' => 'Chọn đơn vị báo giá...'
                            
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'width' => '100%',
                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal3")'),
                    ],
                ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'ghi_chu_bg1')->textarea(['rows' => 6]) ?>
        </div>
    </div>
        <div class='row'>
        <fieldset class="border p-2" style="margin:3px">
            <!--Tai lieu -->
            <div class="row">
                <div class="col">
                    <div class="card-body pd-20 pd-md-40 shadow-none">
                        <h5 class="card-title mg-b-20">Tài liệu</h5>
                        <p class="text-muted card-sub-title mt-1">
                            <?= $model && $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải tài liệu lên':'Chọn file tài liệu.' ?>
                        </p>
                        <?php // '<label class="form-label" style="font-weight:bold">Tài liệu</label>';?>
                        <?php if($model && !$model->isNewRecord): ?>
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
                            <?= $model && $model->isNewRecord ? 'Vui lòng bấm lưu lại để tải ảnh lên':'Chọn file hình ảnh.' ?>
                        </p>
                        <?php // '<label class="form-label" style="font-weight:bold">Hình ảnh</label>';?>
                        <?php if($model && !$model->isNewRecord): ?>
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
    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','visible'=>'visible']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>