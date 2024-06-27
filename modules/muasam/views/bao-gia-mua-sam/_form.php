<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bao-gia-mua-sam-form">

<?php $form = ActiveForm::begin([
        'id' => 'your-model-form',
        'action' => ['/muasam/bao-gia-mua-sam/update','id'=>$model->id],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
    ]); ?>
    
    <?php include __DIR__.'/ct-bao-gia.php' ?>
    <div class="row">
        
        <div class="col-12">
            <?= $form->field($model, 'tong_tien')->textInput(["disabled"=>"disabled",'value'=>number_format($model->tong_tien)]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'ghi_chu_bg1')->textarea(['rows' => 3,'disabled'=>'disabled']) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'ghi_chu_bg2')->textarea(['rows' => 3]) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'trang_thai')->hiddenInput(["type"=>"hidden","id"=>"trang_thai_bg"])->label(false) ?>


    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','visible'=>'visible']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
$script = <<< JS
$(document).ready(function() {
$('.btnSubmit').on('click', function(e) {
    e.preventDefault();
    var trangThai=$(this).attr("value");
    $("#trang_thai_bg").val(trangThai);
    $('#btnSubmitBaoGia').click();
    
    
});
});
JS;
$this->registerJs($script);
?>