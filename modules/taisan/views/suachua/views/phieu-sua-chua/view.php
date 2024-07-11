<?php

use yii\widgets\DetailView;
use app\modules\dungchung\models\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\PhieuSuaChua */
?>
<div class="phieu-sua-chua-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'id_thiet_bi',
                'value'=>$model->thietBi->ten_thiet_bi
            ],
            [
                'attribute'=>'id_tt_sua_chua',
                'value'=>$model->ttSuaChua->ten_bo_phan
            ],
            [
                'attribute'=>'ngay_sua_chua',
                'value'=>function($model){
                    $cus = new CustomFunc();
                    if ($model->ngay_sua_chua != null) {
                        return $cus->convertYMDToDMY($model->ngay_sua_chua);
                    }
                    else return null;
                }
            ],
            [
                'attribute'=>'ngay_du_kien_hoan_thanh',
                'value'=>function($model){
                    $cus = new CustomFunc();
                    if ($model->ngay_du_kien_hoan_thanh != null) {
                        return $cus->convertYMDToDMY($model->ngay_du_kien_hoan_thanh);
                    }
                    else return null;
                }
            ],
            [
                'attribute'=>'ngay_hoan_thanh',
                'value'=>function($model){
                    $cus = new CustomFunc();
                    if ($model->ngay_hoan_thanh != null) {
                        return $cus->convertYMDToDMY($model->ngay_hoan_thanh);
                    }
                    else return null;
                }
            ],

            'ngay_hoan_thanh',
            'phi_linh_kien',
            'phi_khac',
            'tong_tien',
            'trang_thai',
            'nguoi_tao',
            
            [
                'attribute'=>'ngay_tao',
                'value'=>function($model){
                    $cus = new CustomFunc();
                    if ($model->ngay_tao != null) {
                        return $cus->convertYMDHISToDMYHID($model->ngay_tao);
                    }
                    else return null;
                }
            ],

            [
                'attribute'=>'ngay_cap_nhat',
                'value'=>function($model){
                    $cus = new CustomFunc();
                    if ($model->ngay_cap_nhat != null) {
                        return $cus->convertYMDHISToDMYHID($model->ngay_cap_nhat);
                    }
                    else return null;
                }
            ],
            'nguoi_cap_nhat',
            'ghi_chu1:ntext',
            'ghi_chu2:ntext',
            'danh_gia_sc',
        ],
    ]) ?>

</div>
