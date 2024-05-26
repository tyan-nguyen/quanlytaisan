<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\DmTTSuaChua */
?>
<div class="dm-ttsua-chua-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_tt_sua_chua',
            'dien_thoai1',
            'dien_thoai2',
            'dia_chi:ntext',
            'nguoi_lien_he',
            // [
            //     'attribute'=>'danh_gia',
            //     'format'=>'raw',
            //     'value'=>function($model)
            //     {
            //         return '<input type="hidden" class="rating" data-filled="fa-solid fa-star" data-empty="fa-regular fa-star" data-readonly value="'.$model->danh_gia.'"/>';
            //     }
            // ],
        ],
    ]) ?>

</div>
<?php 
    $this->registerCssFile('@web/css/bootstrap-rating.css', [
        //'depends' => [\yii\web\JqueryAsset::className()]
        'position' => \yii\web\View::POS_END
    ]);
?>

