<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;

return [
    
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
    //     'attribute'=>'id_vat_tu',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'so_luong_cu',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'so_luong_moi',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'so_luong',
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nguoi_tao',
        'value'=>function ($model) {
            return $model->nguoiTao->username;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngay_tao',
        'value' => function ($model) {
            $cus = new CustomFunc();
            if ($model->ngay_tao != null) {
                return $cus->convertYMDHISToDMYHID($model->ngay_tao);
            } else {
                return null;
            }

        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghi_chu',
    ],
    

];   