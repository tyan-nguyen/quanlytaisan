<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
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
    //     'attribute'=>'id_phieu_mua_sam',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_ct_phieu_mua_sam_vt',
        'value'=>function($model){
            return $model->ctPhieuMuaSam->ten_vat_tu;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'hang_san_xuat',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'so_luong',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'ghi_chu',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'don_gia',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_vat_tu',
        'format'=>'raw',
        'hAlign'=>GridView::ALIGN_CENTER,
        'value'=>function($model){
            $html='';
            if($model->id_vat_tu)
            $html='<i class="fa fa-check-square-o text-success" data-bs-toggle="tooltip" aria-label="fa fa-check-square-o" data-bs-original-title="Thiết bị đã nhập thành công"></i>';
            return $html;
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_kho',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'don_vi_tinh',
    // ],
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
        'width' => '200px',
        'template'=>'{view} {update}',
        'urlCreator' => function($action, $model, $key, $index) { 
            return Url::to(["/muasam/ct-phieu-nhap-hang-vt/".$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote-2','title'=>'View','title'=>'Xem thông tin',
            'class'=>'btn ripple btn-primary btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-primary'],
        'updateOptions'=>['role'=>'modal-remote-2','title'=>'Cập nhật dữ liệu', 
            'class'=>'btn ripple btn-info btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-info'],
        'deleteOptions'=>['role'=>'modal-remote-2','title'=>'Xóa dữ liệu này', 
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