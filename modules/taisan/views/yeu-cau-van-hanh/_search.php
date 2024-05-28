<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\taisan\models\YeuCauVanHanh;


/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ts-yeu-cau-van-hanh-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'id_nguoi_lap')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_gui')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_duyet')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_xuat')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_nhan')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_yeu_cau')->textInput() ?>

    <?= $form->field($model, 'id_bo_phan_quan_ly')->textInput() ?>

    <?php //$form->field($model, 'id_cong_trinh')->textInput() ?>

    <?= $form->field($model, 'ngay_lap')->textInput() ?>

<?= $form->field($model, 'ngay_gui')->textInput() ?>

    <?= $form->field($model, 'ngay_duyet')->textInput() ?>

    <?= $form->field($model, 'ngay_xuat')->textInput() ?>

    <?= $form->field($model, 'ngay_nhan')->textInput() ?>

    <?= $form->field($model, 'ly_do')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hieu_luc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noi_dung_lap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noi_dung_gui')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noi_dung_duyet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noi_dung_xuat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noi_dung_nhan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dia_diem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
