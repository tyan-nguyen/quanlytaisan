<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\kholuutru\models\LichSuVatTu */
?>
<div class="lich-su-vat-tu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_vat_tu',
            'so_luong_cu',
            'so_luong_moi',
            'so_luong',
            'ghi_chu:ntext',
            'nguoi_tao',
            'ngay_tao',
        ],
    ]) ?>

</div>
