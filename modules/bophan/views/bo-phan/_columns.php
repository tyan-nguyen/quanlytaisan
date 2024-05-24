<?php
use yii\helpers\Url;

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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ma_bo_phan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_bo_phan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'truc_thuoc',
        'value'=>function($model){
            return $model->trucThuoc;
        }
    ],
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'la_dv_quan_ly',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'la_dv_su_dung',
    ], */
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'la_dv_bao_tri',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'la_dv_van_tai',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'la_dv_mua_hang',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'la_dv_quan_ly_kho',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'la_trung_tam_chi_phi',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_kho_vat_tu',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_kho_phe_lieu',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_kho_thanh_pham',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'thoi_gian_tao',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'nguoi_tao',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '200px',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','title'=>'Xem thông tin',
            'class'=>'btn ripple btn-primary btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-primary'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Cập nhật dữ liệu', 
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