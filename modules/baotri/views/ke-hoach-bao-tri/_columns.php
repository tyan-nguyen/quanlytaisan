<?php
use yii\helpers\Url;
use yii\helpers\Html;
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
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
        'width' => '30px',
    ], */
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_he_thong',
        'value'=> function($model){
            if($model->heThong != null){
                return $model->heThong->ten_he_thong;
            } else {
                return ($model->thietBi&&$model->thietBi->heThong)?$model->thietBi->heThong->ten_he_thong:'';
            }
        },
        'width' => '180px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_thiet_bi',
        //'value'=> 'thietBi.ten_thiet_bi',
        'width' => '300px',
        'format'=>'raw',
        'value'=>function($model){
        return $model->thietBi != NULL ? Html::a($model->thietBi->ten_thiet_bi, ['/taisan/thiet-bi/view','id'=>$model->id_thiet_bi],
            ['data-pjax'=>0,'title'=> 'Chi tiết thiết bị', 'class'=>"text-primary", 'role'=>'modal-remote']) : '';
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_loai_bao_tri',
        'value'=> 'loaiBaoTri.ten',
        'width' => '200px',
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_cong_viec',
        'width'=>'250px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'muc_do_uu_tien',
        'format'=>'raw',
        'value'=> 'MucDoUuTienWithBadge',
        'width'=>'100px',
        //["0"=> "Không ưu tiên", "1"=>"Ưu tiên", "2"=>"Xử lý gấp"]
//         'value'=>function($data){
//             if($data["muc_do_uu_tien"]=="0") return "Không ưu tiên";   
//             else if($data["muc_do_uu_tien"]=="1") return "Ưu tiên";
//             else{ return "Xử lý gấp";};
//         }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'thue_ngoai',
        'value'=>'ThueNgoaiWithBadge',
        'format'=>'raw',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_nguoi_chiu_trach_nhiem',
        'value'=>'nguoiChiuTrachNhiem.ten_nhan_vien',
        'width'=>'100px',
    ],
//     [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'id_chi_tiet',
//     ],
   
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngay_bat_dau',
        'value'=>function($model){
            $cus = new CustomFunc();
            return $cus->convertYMDToDMY($model->ngay_bat_dau);
        },
        'width'=>'100px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label'=>'Tần suất',
        'value'=>function($model){
            return $model->so_ky . ' kỳ (' . $model->tan_suat . ' ' . $model->getKyBaoTriLabel($model->ky_bao_tri) . '/lần)';
        },
        'width'=>'200px',
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'bao_truoc',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'can_cu',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'so_ky',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ky_bao_tri',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_don_vi_bao_tri',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_nguoi_chiu_trach_nhiem',
    // ],
  
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'truc_thuoc',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'thoi_gian_thuc_hien',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'don_vi_thoi_gian',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'dung_may',
    // ],
   
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'da_het_hieu_luc',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ngay_het_hieu_luc',
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