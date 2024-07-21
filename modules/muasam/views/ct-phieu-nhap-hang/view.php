<?php

use yii\widgets\DetailView;
use app\modules\dungchung\models\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\CtPhieuNhapHang */
?>
<div class="ct-phieu-nhap-hang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'ma_thiet_bi',
            [
                'attribute'=>'id_vi_tri',
                'value'=>$model->tenViTri
            ],
            [
                'attribute'=>'id_he_thong',
                'value'=>$model->tenHeThong
            ],

            [
                'attribute'=>'id_ct_phieu_mua_sam',
                'value'=>$model->ctPhieuMuaSam->ten_thiet_bi
            ],
            'nam_san_xuat',
            'serial',
            'model',
            'xuat_xu',
            [
                'attribute'=>'id_hang_bao_hanh',
                'value'=>$model->tenHangBaoHanh
            ],  
            //'id_nhien_lieu',
            'dac_tinh_ky_thuat:ntext',
            [
                'attribute'=>'id_don_vi_bao_tri',
                'value'=>$model->tenBoPhanBaoTri
            ],
            [
                'attribute'=>'han_bao_hanh',
                'value'=>function($model){
                    $cus = new CustomFunc();
                    if ($model->han_bao_hanh != null) {
                        return $cus->convertYMDToDMY($model->han_bao_hanh);
                    }
                    else return null;
                }
            ],
            'ghi_chu:ntext',
            [
                'attribute'=>'id_bo_phan_quan_ly',
                'value'=>$model->tenBoPhanQuanLy
            ],          
            [
                'attribute'=>'id_nguoi_quan_ly',
                'value'=>$model->tenNguoiQuanLy
            ],
            [
                'attribute'=>'id_thiet_bi_cha',
                'value'=>$model->tenThietBiCha
            ], 
            //'id_thiet_bi',
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
                    
                   return $model->nguoiTao->username ?? "";
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
    ]) ?>

</div>
