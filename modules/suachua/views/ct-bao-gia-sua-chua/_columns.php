<?php
use yii\helpers\Url;
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
    //     'attribute'=>'id_bao_gia',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_dm_bao_gia',
        'value'=>function($model){
            return $model->getDmBaoGia()[$model->id_dm_bao_gia];
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_danh_muc',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'so_luong',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'don_vi_tinh',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'don_gia',
        'value'=>function($model){
            return number_format($model->don_gia);
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'thanh_tien',
        'value'=>function($model){
            return number_format($model->thanh_tien);
        },
        'footer' => number_format($dataProvider->query->sum("thanh_tien")),
    ],
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
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'visible'=>$checkAction ? true : false,
        'vAlign'=>'middle',
        'width' => '200px',
        'template'=>'{update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(["/suachua/ct-bao-gia-sua-chua/".$action,'id'=>$key]);
        },
        'buttons'=>[
            'view'=>function ($url, $model)  {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ["/suachua/ct-bao-gia-sua-chua/view", "id"=>$model->id],['role'=>'modal-remote','title'=> 'Xem chi tiết','class'=>'btn btn-xs btn-info']);
            },
            'update'=>function ($url, $model) use ($checkAction) {
                if($checkAction)
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ["/suachua/ct-bao-gia-sua-chua/update", "id"=>$model->id],['role'=>'modal-remote','title'=> 'Xem chi tiết','class'=>'btn btn-xs btn-primary']);
            },
            'delete'=>function ($url, $model) use ($checkAction) {
                //$trang_thai=$model->baoGia->trang_thai;
                //\Yii::warning("hi there", 'mycategory');
                if($checkAction)
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', 
                ["/suachua/ct-bao-gia-sua-chua/delete", "id"=>$model->id],
                [
                    'class'=>'btn btn-xs btn-danger',
                    'role'=>'modal-remote','title'=>'Delete', 
                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    'data-request-method'=>'post',
                    'data-toggle'=>'tooltip',
                    'data-confirm-title'=>'Are you sure?',
                    'data-confirm-message'=>'Are you sure want to delete this item'

                ]);
            },
        ],
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