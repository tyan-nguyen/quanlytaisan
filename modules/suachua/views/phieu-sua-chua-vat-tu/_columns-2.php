<?php
use yii\helpers\Url;
use yii\helpers\Html;

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
    //     'attribute'=>'id_phieu_sua_chua',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_vat_tu',
        'value'=>function($model){
            return $model->vtTenVatTu;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'so_luong',
        'value'=>function($model){
            return $model->vtSoLuong;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghi_chu',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'don_vi_tinh',
        'value'=>function($model){
            return $model->vtDonViTinh;
        }
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
        'vAlign'=>'middle',
        'width' => '200px',
        'visible'=>$isCheckUpdate,
        'template'=>'{viewhh} {view} {update} {delete}',
        'visibleButtons' => [
            'update' => function ($model) {
                return $model->id_tb_vt==NULL;
            },
            'view' => function ($model) {
               return $model->id_tb_vt==NULL;
            },
            'viewhh' => function ($model) {
                return $model->id_tb_vt!=NULL;
            },
        ],
        'buttons' => [
            'viewhh' => function ($url, $model, $key) {
            $options = [
                'title' => Yii::t('yii', 'Xem thông tin'),
                'aria-label' => Yii::t('yii', 'Xem thông tin'),
                'data-pjax' => '0',
                'role'=>'modal-remote-2',
                'class'=>'btn ripple btn-primary btn-sm',
                'data-bs-placement'=>'top',
                'data-bs-toggle'=>'tooltip-primary'
            ];
            $url = Url::toRoute(['/taisan/thiet-bi-vat-tu-ajax/view', 'id' => $model->id_tb_vt]);
            
            return Html::a('<i class="fa fa-eye"></i>', $url, $options);
            }
        ],
        'urlCreator' => function($action, $model, $key, $index) { 
                if($action=="update")
                return Url::to(["/suachua/phieu-sua-chua-vat-tu/".$action.'2','id'=>$key]);
                return Url::to(["/suachua/phieu-sua-chua-vat-tu/".$action,'id'=>$key]);
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