<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\PhieuMuaSam */
?>
<div class="phieu-mua-sam-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ngay_yeu_cau',
            'id_nguoi_duyet',
            'tong_phi',
            'trang_thai',
            'ghi_chu:ntext',
            'nguoi_tao',
            'ngay_tao',
            'nguoi_cap_nhat',
            'ngay_cap_nhat',
        ],
    ]) ?>

</div>
