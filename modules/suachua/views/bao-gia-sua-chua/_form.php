<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\widgets\forms\RadioWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\BaoGiaSuaChua */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bao-gia-sua-chua-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php include __DIR__.'/ct-bao-gia.php' ?>
    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'phi_linh_kien')->textInput(["disabled"=>"disabled",'value'=>number_format($model->phi_linh_kien)]) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'phi_khac')->textInput(["disabled"=>"disabled",'value'=>number_format($model->phi_khac)]) ?>
        </div>
        <div class="col-4">
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
    



    <?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>