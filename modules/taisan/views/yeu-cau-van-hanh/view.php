<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanh */
?>
<div class="ts-yeu-cau-van-hanh-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id_nguoi_lap',
                'value' => $model->nguoiLap ? $model->nguoiLap->ten_nhan_vien : '-',
                'label' => 'Người Lập',
            ],

            [
                'attribute' => 'id_nguoi_yeu_cau',
                'value' => $model->nguoiYeuCau ? $model->nguoiYeuCau->ten_nhan_vien : '-',
                'label' => 'Người yêu cầu',

            ],
            'ngay_lap',

            // 'id_nguoi_duyet',
            // 'id_nguoi_xuat',
            // 'id_nguoi_nhan',
            // 'id_nguoi_yeu_cau',
            // 'id_bo_phan_quan_ly',
            // 'ngay_duyet',
            // 'ngay_xuat',
            // 'ngay_nhan',
            'ly_do',
            // 'hieu_luc',
            [
                'attribute' => 'hieu_luc',
                'value' => $model->tenHieuLuc ? $model->tenHieuLuc : '-',
                'label' => 'Hiệu lực',
            ],
            'noi_dung_lap',
            'dia_diem',
            'cong_trinh',

            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h3 class="mt-4">Chi tiết</h3>

    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => $modelsDetail,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_thiet_bi',
                'value' => function ($model) {
                    return $model->thietBi ? $model->thietBi->ten_thiet_bi : "";
                }

            ],
            'ngay_bat_dau',
            'ngay_ket_thuc',

        ],
    ]) ?>

</div>