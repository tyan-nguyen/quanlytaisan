<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuNhapHangVt */
?>
<div class="ct-phieu-nhap-hang-vt-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ctPhieuMuaSam.ten_vat_tu',
            'hang_san_xuat:ntext',
            'so_luong',
            
            [
                'attribute' => 'don_gia',
                'value' => function ($model) {
                    return number_format($model->don_gia);
                },
            ],
            //'id_vat_tu',
            'ctPhieuMuaSam.kho.ten_kho',
            'ctPhieuMuaSam.don_vi_tinh',
            'ghi_chu:ntext',
            // 'nguoi_tao',
            // 'ngay_tao',
            // 'nguoi_cap_nhat',
            // 'ngay_cap_nhat',
        ],
    ]) ?>

</div>
