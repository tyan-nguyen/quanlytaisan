<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;
use yii\bootstrap5\Html;

return [
    
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_thiet_bi',
        'format'=>'raw',
        'value'=>function($model){
            $thietBi=$model->thietBi;
            $html=Html::a($thietBi ? $thietBi->ten_thiet_bi : "", ['/suachua/phieu-sua-chua/chi-tiet-phieu-sua-chua','id_phieu_sua_chua'=>$model->id],
            ['data-pjax'=>0,'title'=> 'Chi tiết phiếu sửa chữa', 'class'=>"text-primary"]);
            return $html;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_tt_sua_chua',
        'value'=>function($model){
            $ttSuaChua=$model->ttSuaChua;
            return $ttSuaChua ? $ttSuaChua->ten_bo_phan : "";
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
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
        'class'=>'\kartik\grid\DataColumn',
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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngay_hoan_thanh',
        'value'=>function($model){
            $cus = new CustomFunc();
            if ($model->ngay_hoan_thanh != null) {
                return $cus->convertYMDToDMY($model->ngay_hoan_thanh);
            }
            else return null;
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'phi_linh_kien',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'phi_khac',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tong_tien',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'trang_thai',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ngay_tao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nguoi_tao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ngay_cap_nhat',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nguoi_cap_nhat',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ghi_chu1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ghi_chu2',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'danh_gia_sc',
    // ],
    

];   