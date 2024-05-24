<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\modules\bophan\models\NhomDoiTac;
use app\widgets\forms\SwitchWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\DoiTac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doi-tac-search">

    <?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm'
            ]
      	]); ?>

    <?= $form->field($model, 'ma_doi_tac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_doi_tac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_nhom_doi_tac')->dropDownList(NhomDoiTac::getList(), ['prompt'=>'--Chọn nhóm đối tác--']) ?>
    
    <?= SwitchWidget::widget([
	    'model'=>$model,
	    'attr'=>'la_nha_cung_cap',
	    'inForm'=>false
	]) ?>
	
	<?= SwitchWidget::widget([
	    'model'=>$model,
	    'attr'=>'la_khach_hang',
	    'inForm'=>false
	]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Tìm kiếm',['class' => 'btn btn-primary']) ?>
	        <?= Html::resetButton('Xóa tìm kiếm', ['class' => 'btn btn-outline-secondary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
