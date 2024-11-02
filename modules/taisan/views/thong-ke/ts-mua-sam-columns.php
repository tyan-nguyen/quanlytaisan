<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\LoaiThietBi;
use app\widgets\views\StatusWithIconWidget;
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
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ma_thiet_bi',
        'width'=> '10%',
        
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_thiet_bi',
        'width'=> '35%',
    ],
    /* [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'id_vi_tri',
     'value'=>'viTri.ten_vi_tri',
     'width'=> '20%',
        
        
     ], */
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_loai_thiet_bi',
        'value'=>'tenLoaiThietBi',
        'width'=> '20%',
        //'filter'=>ArrayHelper::map(LoaiThietBi::find()->asArray()->all(), 'id', 'ten_loai'),
    ],
    /* [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'id_he_thong',
     'value'=>'heThong.ten_he_thong',
     'width'=> '20%',
     ], */
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_bo_phan_quan_ly',
        'value'=>'boPhanQuanLy.ten_bo_phan',
        'width'=> '20%',
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngay_mua',
        'value'=>function($model){
            $custom = new CustomFunc();
            return $custom->convertYMDToDMY($model->ngay_mua);
        },
        'width'=> '15%',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ngay_dua_vao_su_dung',
        'label'=>'Ngày sử dụng',
        'value'=>function($model){
            $custom = new CustomFunc();
            return $custom->convertYMDToDMY($model->ngay_dua_vao_su_dung);
        },
        'width'=> '15%',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_phieu_mua_sam',
        'format'=>'raw',
        'value'=>function($model){
        $html=$model->id_phieu_mua_sam?Html::a('P'.str_pad($model->id_phieu_mua_sam, 6, '0', STR_PAD_LEFT), ['/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam','id_phieu_mua_sam'=>$model->id_phieu_mua_sam],
                ['data-pjax'=>0, 'target'=>'_blank', 'title'=> 'Chi tiết phiếu sửa chữa', 'class'=>"text-primary"]):'';
            return $html;
        },
        'width'=> '15%',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'trang_thai',
        'format'=>'raw',
        'value'=>'tenTrangThaiWithBadge',
        'width'=> '20%',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ten_thiet_bi',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_thiet_bi_cha',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_layout',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'nam_san_xuat',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'serial',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'model',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'xuat_xu',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_hang_bao_hanh',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_nhien_lieu',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'dac_tinh_ky_thuat',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_lop_hu_hong',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_trung_tam_chi_phi',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_don_vi_bao_tri',
    // ],
    
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ngay_mua',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'han_bao_hanh',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ngay_dua_vao_su_dung',
    // ],
    
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ngay_ngung_hoat_dong',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ghi_chu',
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
        'urlCreator' => function($action, $model, $key, $index) {
        return Url::to([$action,'id'=>$key]);
        },
        'template'=>'{view}',
        'urlCreator' => function($action, $model, $key, $index) {
            if ($action === 'view') {
                return Url::to(['/taisan/thiet-bi/view', 'id' => $key]);
            }
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions'=>[
            'role'=>'modal-remote','title'=>'Xem chi tiết',
            'data-toggle'=>'tooltip',
            'class'=>'btn ripple btn-primary btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-primary'
        ],
        'updateOptions'=>[
            'role'=>'modal-remote','title'=>'Cập nhật', 'data-toggle'=>'tooltip',
            'class'=>'btn ripple btn-info btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-info'
        ],
        'deleteOptions'=>[
            'role'=>'modal-remote','title'=>'Xoá',
            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
            'data-request-method'=>'post',
            'data-toggle'=>'tooltip',
            'data-confirm-title'=>'Thông báo',
            'data-confirm-message'=>'Để không ảnh hưởng dữ liệu liên quan vui lòng cập nhật trạng thái tài sản đã hỏng hoặc đã thanh lý. Dữ liệu liên quan tài sản/thiết bị như: lịch sử thay đổi, lịch sử sữa chữa, phiếu bảo trì, kế hoạch bảo trì, tài liệu sẽ cũng được xóa theo. Bạn có chắc xoá dòng được chọn không?',
            'class'=>'btn ripple btn-secondary btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-secondary'
        ],
        ],
        
        ];   