<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sua-chua-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'id_thiet_bi')->textInput() ?>

    <?= $form->field($model, 'id_tt_sua_chua')->textInput() ?>

    <?= $form->field($model, 'ngay_sua_chua')->textInput() ?>

    <?= $form->field($model, 'ngay_du_kien_hoan_thanh')->textInput() ?>

    <?= $form->field($model, 'ngay_hoan_thanh')->textInput() ?>

    <?= $form->field($model, 'phi_linh_kien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phi_khac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tong_tien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trang_thai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'ngay_cap_nhat')->textInput() ?>

    <?= $form->field($model, 'nguoi_cap_nhat')->textInput() ?>

    <?= $form->field($model, 'ghi_chu1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ghi_chu2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'danh_gia_sc')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
