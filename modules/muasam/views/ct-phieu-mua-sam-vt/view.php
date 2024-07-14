<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuMuaSamVt */
?>
<div class="ct-phieu-mua-sam-vt-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_vat_tu',
            'kho.ten_kho',
            'hang_san_xuat',
            'so_luong',
            //'trang_thai',
            'ghi_chu:ntext',
            // 'nguoi_tao',
            // 'ngay_tao',
            // 'nguoi_cap_nhat',
            // 'ngay_cap_nhat',
        ],
    ]) ?>

</div>
