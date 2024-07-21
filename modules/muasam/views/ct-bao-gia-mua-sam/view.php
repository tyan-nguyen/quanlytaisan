<?php

use yii\widgets\DetailView;
use app\modules\dungchung\models\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtBaoGiaMuaSam */
?>
<div class="ct-bao-gia-mua-sam-view">

    <?=DetailView::widget([
    'model' => $model,
    'attributes' => [
        //'id',
        [
            'attribute' => 'id_ct_phieu_mua_sam',
            'value' => function ($model) {
                return $model->ctPhieuMuaSam->ten_thiet_bi;
            },

        ],
        'nam_san_xuat',
        'model',
        'xuat_xu',
        'dac_tinh_ky_thuat:ntext',
        'han_bao_hanh',
        'so_luong',
        'ghi_chu:ntext',
        [
            'attribute'=>'don_gia',
            'value'=>function($model){
                return number_format($model->don_gia);
            }
        ],
        [
            'attribute'=>'thanh_tien',
            'value'=>function($model){
                return number_format($model->thanh_tien);
            }
        ],
        [
            'attribute'=>'ngay_tao',
            'value'=>function($model){
                $cus = new CustomFunc();
                if ($model->ngay_tao != null) {
                    return $cus->convertYMDToDMY($model->ngay_tao);
                }
                else return null;
            }
        ],
        
        
        [
            'attribute'=>'nguoi_tao',
            'value'=>function($model){
               return $model->nguoiTao->username;
            }
        ],
        [
            'attribute'=>'ngay_cap_nhat',
            'value'=>function($model){
                $cus = new CustomFunc();
                if ($model->ngay_cap_nhat != null) {
                    return $cus->convertYMDToDMY($model->ngay_cap_nhat);
                }
                else return null;
            }
        ],
       
        
        [
            'attribute'=>'nguoi_cap_nhat',
            'value'=>function($model){
               return $model->nguoiCapNhat->username ?? "";
            }
        ],
    ],
])?>

</div>