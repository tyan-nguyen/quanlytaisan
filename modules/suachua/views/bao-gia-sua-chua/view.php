<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\BaoGiaSuaChua */
?>
<div class="bao-gia-sua-chua-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_phieu_sua_chua',
            'so_bao_gia',
            'flag_index',
            'ngay_bao_gia',
            'ngay_ket_thuc',
            'ngay_gui_bg',
            'trang_thai',
            'phi_linh_kien',
            'phi_khac',
            'tong_tien',
            'ghi_chu_bg1:ntext',
            'ghi_chu_bg2:ntext',
            'ngay_tao',
            'nguoi_tao',
            'ngay_cap_nhat',
            'nguoi_cap_nhat',
            'nguoi_duyet_bg',
        ],
    ]) ?>

</div>
