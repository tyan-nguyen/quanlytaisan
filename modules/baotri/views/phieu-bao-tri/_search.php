<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\PhieuBaoTri */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-bao-tri-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'id_ke_hoach')->textInput() ?>

    <?= $form->field($model, 'ky_thu')->textInput() ?>

    <?= $form->field($model, 'id_don_vi_bao_tri')->textInput() ?>

    <?= $form->field($model, 'id_nguoi_chiu_trach_nhiem')->textInput() ?>

    <?= $form->field($model, 'thoi_gian_bat_dau')->textInput() ?>

    <?= $form->field($model, 'thoi_gian_ket_thuc')->textInput() ?>

    <?= $form->field($model, 'noi_dung_thuc_hien')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thoi_gian_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
