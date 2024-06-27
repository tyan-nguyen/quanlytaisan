<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuNhapHang */
?>
<div class="phieu-nhap-hang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'so_phieu',
            'ngay_nhap_hang',
            'id_phieu_mua_sam',
            'trang_thai',
            'ghi_chu:ntext',
            'nguoi_tao',
            'ngay_tao',
            'nguoi_cap_nhat',
            'ngay_cap_nhat',
        ],
    ]) ?>

</div>
