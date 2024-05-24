<?php
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
?>


<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'],]); ?>

<div class="row text-center">
    <div class="col-12">
        <?= Html::img(Yii::getAlias('@web/uploads/icons/qr-code.png'), ['width'=>'200px']) ?>
    </div>
    <div class="col-12">
        <?= $form->field($model, 'autoid')->textInput(['id'=>'txtQrcode', 'autofocus'=>true, 'class'=>'text-qr']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script>
$("#txtQrcode").keyup(function(event) {
    if (event.keyCode === 13) {
      $("#btnQrScan").click();
    }
});    
</script>