<?php
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use app\widgets\forms\RadioWidget;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\BaoGiaSuaChua */
/* @var $form yii\widgets\ActiveForm */

$isCheckUpdate=$phieuSuaChua->trang_thai !== 'completed';
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
            <span class="badge rounded-pill bg-<?= $model->getColorTrangThai()[$model->trang_thai] ?>"><?= $model->getDmTrangThai()[$model->trang_thai] ?></span>
            
        
        </div>
    </div>
    



    <?php if ($isCheckUpdate && $model->trang_thai ==='draft'){ ?>
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
        
    </div>
    <?php } ?>
 
    <?php ActiveForm::end(); ?>

</div>