<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\kholuutru\models\KhoLuuTru;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use app\modules\taisan\models\ThietBiVatTu;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChuaVatTu */
/* @var $form yii\widgets\ActiveForm */
$vatTu=$model->vatTu;

?>

<div class="phieu-sua-chua-vat-tu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
        <div class="form-group">
        
        <?= $form->field($model, 'id_tb_vt')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(
                ThietBiVatTu::find()
                    ->where([
                        'id_thiet_bi'=>$modelSuaChua->id_thiet_bi,
                    ])
                ->andWhere("trang_thai IN ('HOATDONG','SUACHUA')")
                ->all(), 
                'id', function($md) {
                return ($md->vatTu?($md->vatTu->ten_vat_tu 
                    . ($md->model?(' -model:'.$md->model):'')
                    . ($md->so_serial?(' -serial:'.$md->so_serial):'')
                    . ' -'. $md->tenTrangThai):'');
                }),
            'options' => [
                'placeholder' => 'Chọn vật tư/phụ tùng',
                'id' => 'id_tb_vt',
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%',
                'dropdownParent' => new yii\web\JsExpression('$("#ajaxCrudModal2")'),
            ],
        ]) ?>
    	</div>

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