<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\NhomDoiTac */
?>
<div class="nhom-doi-tac-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'ma_nhom',
            'ten_nhom',
            /* 'thoi_gian_tao',
            'nguoi_tao', */
        ],
    ]) ?>

</div>
