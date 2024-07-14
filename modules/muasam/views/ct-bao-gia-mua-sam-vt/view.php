<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtBaoGiaMuaSamVt */
?>
<div class="ct-bao-gia-mua-sam-vt-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_bao_gia',
            'id_ct_phieu_mua_sam',
            'hang_san_xuat:ntext',
            'so_luong',
            'ghi_chu:ntext',
            'don_gia',
            'thanh_tien',
            'nguoi_tao',
            'ngay_tao',
            'nguoi_cap_nhat',
            'ngay_cap_nhat',
        ],
    ]) ?>

</div>
