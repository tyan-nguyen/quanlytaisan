<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\modules\bophan\models\DoiTac;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bao-gia-mua-sam-form">

    <?php $form = ActiveForm::begin([
        'id' => 'your-model-form-bao-gia',
        'action' => ['/muasam/bao-gia-mua-sam/create','id_phieu_mua_sam'=>$model->id_phieu_mua_sam],
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
                            'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
                    ],
                ]);?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'ghi_chu_bg1')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','visible'=>'visible']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>