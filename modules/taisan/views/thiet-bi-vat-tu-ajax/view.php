<?php

use yii\widgets\DetailView;
use app\modules\dungchung\models\CustomFunc;
use app\modules\user\models\User;
use yii\helpers\Html;
$custom = new CustomFunc();

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanhCt */
?>
<div class="ts-yeu-cau-van-hanh-ct-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_thiet_bi',
            'qr_code'=>[
                'attribute'=>'qr_code',
                'format'=>'html',
                'value'=>Html::img($model->qrCode, ['width' => 100])
            ],
            'trang_thai'=>[
                'attribute'=>'trang_thai',
                'value'=>$model->tenTrangThai,
            ],
            'vatTu.ten_vat_tu',
            'model',
            'so_serial',
            'ghi_chu',
            'tru_ton_kho'=>[
                'label'=>'Trừ tồn kho khi thêm vào thiết bị',
                'attribute'=>'tru_ton_kho',
                'value'=>$model->tru_ton_kho?'Có':'Không',
            ],
            'thoi_gian_tao'=>[
                'attribute'=>'thoi_gian_tao',
                'value'=>$custom->convertYMDHISToDMYHID($model->thoi_gian_tao)
            ],
            'nguoi_tao'=>[
                'attribute'=>'nguoi_tao',
                'value'=>User::getUsernameByID($model->nguoi_tao)
            ]
        ],
    ]) ?>

</div>
