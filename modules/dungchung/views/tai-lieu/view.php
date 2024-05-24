<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\dungchung\models\TaiLieu */
?>
<div class="tai-lieu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'loai',
            'id_tham_chieu',
            'ten_tai_lieu',
            'duong_dan',
            'ten_file_luu',
            'file_extension',
            'file_size',
            'ghi_chu:ntext',
            'thoi_gian_tao',
            'nguoi_tao',
        ],
    ]) ?>

</div>
