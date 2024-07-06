<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\DmDvBaoGia */
?>
<div class="dm-dv-bao-gia-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ten_don_vi',
            'dien_thoai1',
            'dien_thoai2',
            'dia_chi:ntext',
            'nguoi_lien_he',
            'danh_gia',
        ],
    ]) ?>

</div>
