<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuMuaSam */
?>
<div class="ct-phieu-mua-sam-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_phieu_mua_sam',
            'ten_thiet_bi',
            'id_loai_thiet_bi',
            'dac_tinh_ky_thuat:ntext',
            'so_luong',
            'trang_thai',
            'ghi_chu:ntext',
            'nguoi_tao',
            'ngay_tao',
            'nguoi_cap_nhat',
            'ngay_cap_nhat',
        ],
    ]) ?>

</div>
