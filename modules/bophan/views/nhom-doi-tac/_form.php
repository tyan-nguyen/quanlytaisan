<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\NhomDoiTac */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhom-doi-tac-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ma_nhom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_nhom')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>
    
</div>
