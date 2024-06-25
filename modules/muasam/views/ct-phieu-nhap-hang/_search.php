<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuNhapHang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ct-phieu-nhap-hang-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ma_thiet_bi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_vi_tri')->textInput() ?>

    <?= $form->field($model, 'id_he_thong')->textInput() ?>

    <?= $form->field($model, 'id_thiet_bi_cha')->textInput() ?>

    <?= $form->field($model, 'id_phieu_mua_sam')->textInput() ?>

    <?= $form->field($model, 'id_ct_phieu_mua_sam')->textInput() ?>

    <?= $form->field($model, 'nam_san_xuat')->textInput() ?>

    <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xuat_xu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_hang_bao_hanh')->textInput() ?>

    <?= $form->field($model, 'id_nhien_lieu')->textInput() ?>

    <?= $form->field($model, 'dac_tinh_ky_thuat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_don_vi_bao_tri')->textInput() ?>

    <?= $form->field($model, 'han_bao_hanh')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_nguoi_quan_ly')->textInput() ?>

    <?= $form->field($model, 'id_bo_phan_quan_ly')->textInput() ?>

    <?= $form->field($model, 'id_thiet_bi')->textInput() ?>

    <?= $form->field($model, 'nguoi_tao')->textInput() ?>

    <?= $form->field($model, 'ngay_tao')->textInput() ?>

    <?= $form->field($model, 'nguoi_cap_nhat')->textInput() ?>

    <?= $form->field($model, 'ngay_cap_nhat')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
