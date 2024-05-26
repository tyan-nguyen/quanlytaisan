<?php
use app\modules\dungchung\models\CustomFunc;
use app\modules\suachua\models\DmTTSuaChua;
use app\modules\taisan\models\ThietBiBase;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */
/* @var $form yii\widgets\ActiveForm */
$cus = new CustomFunc();

?>

<div class="phieu-sua-chua-form">

    <div class="row">
        <div class="col-5">

            <?=$form->field($model, 'id_thiet_bi')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(ThietBiBase::find()->all(), 'id', 'ten_thiet_bi'),
                'language' => 'vi',
                'options' => ['placeholder' => 'Chọn thiết bị...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
                ],
            ]);?>
        </div>
        <div class="col-5">
            <?=$form->field($model, 'id_tt_sua_chua')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(DmTTSuaChua::find()->all(), 'id', 'ten_tt_sua_chua'),
    'language' => 'vi',
    'options' => ['placeholder' => 'Chọn trung tâm sửa chữa...'],
    'pluginOptions' => [
        'allowClear' => true,
        'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal")'),
    ],
]);?>
        </div>
        <div class="col-2">
            <?=$form->field($model, 'danh_gia_sc')->textInput()?>

        </div>
    </div>



    <?php if (!Yii::$app->request->isAjax) {?>
    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>
    <?php }?>


</div>