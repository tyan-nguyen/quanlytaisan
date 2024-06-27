<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanh */
?>
<div class="ts-yeu-cau-van-hanh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_nguoi_lap',
            'id_nguoi_yeu_cau',
            'id_nguoi_gui',
            'id_nguoi_duyet',
            'id_nguoi_xuat',
            'id_nguoi_nhan',
            'id_bo_phan_quan_ly',
            'cong_trinh',
            'ngay_lap',
            'ngay_gui',
            'ngay_duyet',
            'ngay_xuat',
            'ngay_nhan',
            'ly_do',
            'hieu_luc',
            'noi_dung_lap',
            'noi_dung_gui',
            'noi_dung_duyet',
            'noi_dung_xuat',
            'noi_dung_nhan',
            'dia_diem',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
