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
        'attribute'=>'loai_thiet_bi',
        'value'=>'tenLoaiThietBi'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ma_loai',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_loai',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'don_vi_tinh',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'truc_thuoc',
        'value'=>'tenTrucThuoc'
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Xem','data-toggle'=>'tooltip','class'=>'btn ripple btn-primary btn-sm'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Sửa', 'data-toggle'=>'tooltip','class'=>'btn ripple btn-info btn-sm'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Xóa', 'class'=>'btn ripple btn-secondary btn-sm',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Thông báo?',
                          'data-confirm-message'=>'Bạn có chắc xoá dòng chọn không?'], 
    ],

];   