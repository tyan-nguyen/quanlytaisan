<?php
use app\widgets\LinkToModalWidget;
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
        'attribute'=>'ma_kho',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_kho',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'loai_kho',
        'value'=>'tenLoaiKho'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_nguoi_quan_ly',
        //'value'=>'tenNguoiQuanLy',
        'format'=>'raw',
        'value'=>function($model){
            return $model->nguoiQuanLy != NULL ? LinkToModalWidget::widget([
                    'label'=>$model->tenNguoiQuanLy, 
                    'link'=>$model->nguoiQuanLy->showLink
                ]) : '';
            }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_bo_phan_quan_ly',
        //'value'=>'tenBoPhanQuanLy',
        'format'=>'raw',
        'value'=>function($model){
            return $model->boPhanQuanLy != NULL ? LinkToModalWidget::widget([
                    'label'=>$model->tenBoPhanQuanLy,
                    'link'=>$model->boPhanQuanLy->showLink
                ]):'';
            }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gia_tri_toi_da',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'dien_thoai',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'email',
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