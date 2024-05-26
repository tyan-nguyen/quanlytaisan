<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChuaVatTu */
?>
<div class="phieu-sua-chua-vat-tu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'id_phieu_sua_chua',
            'vatTu.ten_vat_tu',
            'so_luong',
            'ghi_chu:ntext',
            'don_vi_tinh',
            'ngay_tao',
            'nguoi_tao',
            'ngay_cap_nhat',
            'nguoi_cap_nhat',
        ],
    ]) ?>

</div>
