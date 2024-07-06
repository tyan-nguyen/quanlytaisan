<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;

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
        'attribute'=>'id_phieu_mua_sam',
        'format'=>'raw',
        'value'=>function($model){
            $html='P'.str_pad($model->id_phieu_mua_sam, 6, '0', STR_PAD_LEFT);;
            return $html;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_dv_bao_gia',
        'value'=>function($model){
            $dv=$model->dvBaoGia;
            $tenDv=$dv ? $dv->ten_doi_tac : '';
            return $tenDv;
        }
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'flag_index',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'ngay_bao_gia',
    // ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngay_gui_bg',
        'value'=>function($model){
            $cus = new CustomFunc();
            if ($model->ngay_gui_bg != null) {
                return $cus->convertYMDHISToDMYHID($model->ngay_gui_bg);
            }
            else return null;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'trang_thai',
        'format'=>'raw',
        'value'=>function($model){
            $html='<span class="badge rounded-pill bg-'.$model->getColorTrangThai()[$model->trang_thai].'">'.$model->getDmTrangThai()[$model->trang_thai].'</span>';
            return $html;
            //return $model->getDmTrangThai()[$model->trang_thai];
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tong_tien',
        'value'=>function($model){
            return number_format($model->tong_tien);
        },
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ghi_chu_bg1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ghi_chu_bg2',
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
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'ngay_ket_thuc',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nguoi_duyet_bg',
        'value'=>function($model){
            return $model->nguoiDuyet->username ?? "";
         }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '200px',
        'template'=>'{view} {update}',
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