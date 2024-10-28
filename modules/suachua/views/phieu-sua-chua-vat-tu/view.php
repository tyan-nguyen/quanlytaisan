<?php

use yii\widgets\DetailView;
use app\modules\user\models\User;
use app\modules\dungchung\models\CustomFunc;
$custom = new CustomFunc();

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChuaVatTu */
?>
<div class="phieu-sua-chua-vat-tu-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_phieu_sua_chua',
            'ten_vat_tu'=>[
                'attribute'=>'ten_vat_tu',
                'value'=>$model->trang_thai=='new'?$model->vatTu->ten_vat_tu:$model->ten_vat_tu
            ],
            //'vatTu.ten_vat_tu',
            'so_luong',
            'ghi_chu:ntext',
            'don_vi_tinh',
            'ngay_tao'=>[
                'attribute'=>'ngay_tao',
                'value'=>$custom->convertYMDHISToDMYHID($model->ngay_tao)
            ],
            'nguoi_tao'=>[
                'attribute'=>'nguoi_tao',
                'value'=>User::getUsernameByID($model->nguoi_tao)
            ],
            'ngay_cap_nhat'=>[
                'attribute'=>'ngay_cap_nhat',
                'value'=>$custom->convertYMDHISToDMYHID($model->ngay_cap_nhat)
            ],
            'nguoi_cap_nhat'=>[
                'attribute'=>'nguoi_cap_nhat',
                'value'=>User::getUsernameByID($model->nguoi_cap_nhat)
            ]
        ],
    ]) ?>

</div>
