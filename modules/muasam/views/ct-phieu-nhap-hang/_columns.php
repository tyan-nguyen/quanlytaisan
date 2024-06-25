<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;
use kartik\grid\GridView;

$isUpdated=$model->trang_thai != 'completed';

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'ma_thiet_bi',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_vi_tri',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_he_thong',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_thiet_bi_cha',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_phieu_mua_sam',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_ct_phieu_mua_sam',
        'value'=>function($model){
            return $model->ctPhieuMuaSam->ten_thiet_bi;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nam_san_xuat',
        'hAlign'=>GridView::ALIGN_CENTER,
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'serial',
        'hAlign'=>GridView::ALIGN_CENTER,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'model',
        'hAlign'=>GridView::ALIGN_CENTER,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'xuat_xu',
        'hAlign'=>GridView::ALIGN_CENTER,
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_hang_bao_hanh',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_nhien_lieu',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'dac_tinh_ky_thuat',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_don_vi_bao_tri',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'han_bao_hanh',
        'hAlign'=>GridView::ALIGN_CENTER,
        'value'=>function($model){
            $cus = new CustomFunc();
            if ($model->han_bao_hanh != null) {
                return $cus->convertYMDToDMY($model->han_bao_hanh);
            }
            else return null;
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ghi_chu',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_nguoi_quan_ly',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_bo_phan_quan_ly',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_thiet_bi',
        'format'=>'raw',
        'hAlign'=>GridView::ALIGN_CENTER,
        'value'=>function($model){
            $html='';
            if($model->id_thiet_bi)
            $html='<i class="fa fa-check-square-o text-success" data-bs-toggle="tooltip" aria-label="fa fa-check-square-o" data-bs-original-title="Thiết bị đã nhập thành công"></i>';
            return $html;
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nguoi_tao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ngay_tao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nguoi_cap_nhat',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ngay_cap_nhat',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '120px',
        //'visible'=>$isUpdated,
        'template'=>'{view} {update}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(["/muasam/ct-phieu-nhap-hang/".$action,'id'=>$key]);
        },
        'buttons'=>[
            'update' => function ($url, $model, $key) {
                return !$model->id_thiet_bi;
            },
        ],
        'viewOptions'=>['role'=>'modal-remote-2','title'=>'View','title'=>'Xem thông tin',
            'class'=>'btn ripple btn-primary btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-primary'],
        'updateOptions'=>['role'=>'modal-remote-2','title'=>'Cập nhật dữ liệu', 
            'class'=>'btn ripple btn-info btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-info'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Xóa dữ liệu này', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Xác nhận xóa dữ liệu?',
                          'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?',
                           'class'=>'btn ripple btn-secondary btn-sm',
                           'data-bs-placement'=>'top',
                           'data-bs-toggle'=>'tooltip-secondary'], 
    ],

];   