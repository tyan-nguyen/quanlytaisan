<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\kholuutru\models\KhoLuuTru;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChuaVatTu */
/* @var $form yii\widgets\ActiveForm */
$vatTu=$model->vatTu;
?>

<div class="phieu-sua-chua-vat-tu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-5">
        <div class="form-group">
        <?= Html::label('Kho Vật Tư', 'kho-vat-tu', ['class' => 'control-label']) ?>
        <?= Select2::widget([
            'name' => 'kho_vat_tu',
            'data' => ArrayHelper::map(KhoLuuTru::find()->all(), 'id', 'ten_kho'),
            'value'=>$vatTu ? $vatTu->id_kho : "",
            'options' => [
                'placeholder' => 'Chọn kho vật tư',
                'id' => 'kho-vat-tu',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
            ],
            'pluginEvents' => [
                'change' => new JsExpression("
                    function() {
                        $.ajax({
                            url: '" . Url::to(['/kholuutru/kho/get-vat-tu-list']) . "',
                            type: 'POST',
                            data: {kho_vat_tu: $(this).val()},
                            success: function(data) {
                                var newOptions = [];
                                $.each(data, function(index, value) {
                                    newOptions.push(new Option(value, index, false, false));
                                });
                                $('#id_vat_tu').empty().append(newOptions).trigger('change');
                            }
                        });
                    }
                "),
            ],
        ]) ?>
    </div>

        </div>
        <div class="col-5">
        <?= $form->field($model, 'id_vat_tu')->widget(Select2::classname(), [
            'data' => $model->getVatTuByKho(),
            'options' => [
                'placeholder' => 'Chọn vật tư',
                'id' => 'id_vat_tu',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
            ],
        ]) ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'so_luong')->textInput() ?>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 3]) ?>
        </div>
    </div>


    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>