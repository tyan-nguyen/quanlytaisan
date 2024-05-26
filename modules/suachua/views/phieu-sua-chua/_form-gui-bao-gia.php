<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\widgets\forms\RadioWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\BaoGiaSuaChua */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bao-gia-sua-chua-form">

    <?php $form = ActiveForm::begin([
        'action' => ['/suachua/bao-gia-sua-chua/update','id'=>$model->id]
    ]); ?>
    <div class="row">
        <div class="col-12">
        
        </div>
    </div>
    
    <div class="row">
        <div class="col-8">
            <?= $form->field($model, 'ghi_chu_bg1')->textarea(['rows' => 3,'disabled'=>($model->trang_thai !=='draft')]) ?>
        </div>
        <div class="col-4">
        
        
            Trạng thái báo giá:
            <span class="badge rounded-pill bg-primary"><?= $model->getDmTrangThai()[$model->trang_thai] ?></span>
            
        
        </div>
    </div>
    



    <?php if ($model->trang_thai ==='draft'){ ?>
    <div class="form-group text-center">
    <?= Html::a(' Gửi báo giá', null, [
                'class' => 'btn btn-success',
                'style'=>"margin-left:5px",
                'data' => [
                    'method' => 'post',
                    'params'=>['BaoGiaSuaChua[trang_thai]'=>'submited']
                ]
            ]);
    ?>
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>
 
    <?php ActiveForm::end(); ?>

</div>