<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanhCt */
?>
<div class="ts-yeu-cau-van-hanh-ct-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_thiet_bi',
            'id_yeu_cau_van_hanh',
            'ngay_bat_dau',
            'ngay_ket_thuc',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
