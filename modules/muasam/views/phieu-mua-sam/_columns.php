<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;
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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
        'format'=>'raw',
        'value'=>function($model){
            $html=Html::a('P'.str_pad($model->id, 6, '0', STR_PAD_LEFT), ['chi-tiet-phieu-mua-sam','id_phieu_mua_sam'=>$model->id],
            ['data-pjax'=>0,'title'=> 'Chi tiết phiếu sửa chữa', 'class'=>"text-primary"]);
            return $html;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngay_yeu_cau',
        'value'=>function($model){
            $cus = new CustomFunc();
            if ($model->ngay_yeu_cau != null) {
                return $cus->convertYMDToDMY($model->ngay_yeu_cau);
            }
            else return null;
        }
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tong_phi',
        'value'=>function($model){
            return number_format($model->tong_phi);
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'trang_thai',
        'value'=>function($model){
            //$html='<span class="badge rounded-pill bg-'.$model->getColorTrangThai()[$model->trang_thai].'">'.$model->getDmTrangThai()[$model->trang_thai].'</span>';
            return $model->getDmTrangThai()[$model->trang_thai];
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ghi_chu',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_nguoi_duyet',
        'value'=>function($model){
            return $model->nguoiDuyet->username ?? "";
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
        'width' => '200px',
        'template'=>'{delete}',
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