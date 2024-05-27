<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\CtBaoGiaSuaChua */
/* @var $form yii\widgets\ActiveForm */
//var_dump($model->id_bao_gia);
?>

<div class="ct-bao-gia-sua-chua-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'id_dm_bao_gia')->widget(Select2::classname(), [
    'data' => $model->getDmBaoGia(),
    'language' => 'vi',
    'options' => ['placeholder' => 'Chọn ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '100%',
        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
    ],
]);?>
        </div>
        <div class="col-8">
            <?= $form->field($model, 'ten_danh_muc')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'don_vi_tinh')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'so_luong')->textInput(["type"=>'number']) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'don_gia')->textInput(['maxlength' => true,"type"=>'number']) ?>
        </div>

    </div>



    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>