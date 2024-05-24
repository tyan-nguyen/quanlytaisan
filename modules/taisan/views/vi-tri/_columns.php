<?php
use yii\helpers\Url;
use app\widgets\views\StatusWithIconWidget;

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
        'attribute'=>'ma_vi_tri',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_vi_tri',
    ],
   /*  [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'mo_ta',
    ], */
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'truc_thuoc',
        'value'=>'tenViTriTrucThuoc'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'da_ngung_hoat_dong',
        'format'=>'raw',
        'value'=>function($model){
            return $model->da_ngung_hoat_dong ==1 ? StatusWithIconWidget::widget([
                'label' => 'Ngưng HĐ',
                'icon'=>'fe fe-x',
                'type'=>'warning'
            ]) : '';
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ngay_ngung_hoat_dong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_layout',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
       'attribute'=>'toa_do_x',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'toa_do_y',
    ],
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