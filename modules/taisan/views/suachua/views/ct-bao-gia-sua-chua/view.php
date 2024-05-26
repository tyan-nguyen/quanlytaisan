<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\CtBaoGiaSuaChua */
?>
<div class="ct-bao-gia-sua-chua-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'id_bao_gia',
            
            [
                'attribute'=>'id_dm_bao_gia',
                'value'=>function($model){
                    return $model->getDmBaoGia()[$model->id_dm_bao_gia];;
                }
            ],
            'ten_danh_muc',
            'so_luong',
            'don_vi_tinh',
            'don_gia',
            'thanh_tien',
            'ngay_tao',
            'nguoi_tao',
            'ngay_cap_nhat',
            'nguoi_cap_nhat',
        ],
    ]) ?>

</div>
