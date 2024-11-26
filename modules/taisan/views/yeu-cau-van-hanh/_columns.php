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
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id',
        'value' => function ($model) {

            return  'P-' . substr("0000000{$model->id}", -6);
        },
        'label' => 'Số Phiếu'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'loai_phieu',
        "format" => 'raw',
        'value' => function ($model) {
            return $model->loaiPhieuWithBadge;
        }
        ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_nguoi_lap',
        "format" => 'raw',
        'value' => function ($model) {
        return ($model->nguoiLap!=null?$model->nguoiLap->ten_nhan_vien:'')
                . "<br>"
                . '<span class="badge bg-light text-dark">'
                . $model->ngayLap . "</span>"
                ?? "-";
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_nguoi_yeu_cau',
        "format" => 'raw',
        'value' => function ($model) {
        return ($model->nguoiYeuCau!=null?$model->nguoiYeuCau->ten_nhan_vien:'')
                . "<br>"
                . '<span class="badge bg-light text-dark">'
                . $model->ngayLap . "</span>"
                ?? "-";
        }
    ],

    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_nguoi_duyet',
        "format" => 'raw',
        'value' => function ($model) {
            $ngayDuyet =  '<br><span class="badge bg-light text-dark">' . $model->ngayDuyet . "</span>" ?? "";
            return $model->nguoiDuyet ? ($model->nguoiDuyet->username) . $ngayDuyet : "-";
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_nguoi_xuat',
        "format" => 'raw',
        'value' => function ($model) {
            $ngayXuat =  '<br><span class="badge bg-light text-dark">' . $model->ngayXuat . "</span>" ?? "";
            return $model->nguoiXuat ? ($model->nguoiXuat->username) . $ngayXuat : "-";
            return ($model->nguoiXuat->ten_nhan_vien) ?? "-";
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'id_nguoi_nhan',
        "format" => 'raw',
        'value' => function ($model) {
            $ngayNhan =  '<br><span class="badge bg-light text-dark">' . $model->ngayNhan . "</span>" ?? "";
            return $model->nguoiNhan ? ($model->nguoiNhan->ten_nhan_vien) . $ngayNhan : "-";
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'hieu_luc',
        'format' => 'raw',
        'value' => 'tenHieuLucWithBadge'
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_bo_phan',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_cong_trinh',
    // ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'ngay_lap',
    //     'value' => function ($model) {
    //         return $model->ngayLap;
    //     }
    // ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'ngay_duyet',
    //     'value' => function ($model) {
    //         return $model->ngayDuyet;
    //     }
    // ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'ngay_xuat',
    //     'value' => function ($model) {
    //         return $model->ngayXuat;
    //     }
    // ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'ngay_nhan',
    //     'value' => function ($model) {
    //         return $model->ngayNhan;
    //     }
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ngay_bat_dau',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ngay_ket_thuc',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'ly_do',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'hieu_luc',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'noi_dung_lap',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'noi_dung_duyet',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'noi_dung_xuat',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'noi_dung_nhan',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'dia_diem',
    // ],
    // [
    //     'class' => '\kartik\grid\DataColumn',
    //     'attribute' => 'created_at',
    //     'value' => function ($model) {
    //         return $model->createdAt;
    //     }
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'updated_at',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'deleted_at',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'width' => '200px',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => [
            'role' => 'modal-remote', 'title' => 'View', 'title' => 'Xem thông tin',
            'class' => 'btn ripple btn-primary btn-sm',
            'data-bs-placement' => 'top',
            'data-bs-toggle' => 'tooltip-primary'
        ],
        'updateOptions' => [
            'role' => 'modal-remote', 'title' => 'Cập nhật dữ liệu',
            'class' => 'btn ripple btn-info btn-sm',
            'data-bs-placement' => 'top',
            'data-bs-toggle' => 'tooltip-info'
        ],
        'deleteOptions' => [
            'role' => 'modal-remote', 'title' => 'Xóa dữ liệu này',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Xác nhận xóa dữ liệu?',
            'data-confirm-message' => 'Bạn có chắc chắn thực hiện hành động này?',
            'class' => 'btn ripple btn-secondary btn-sm',
            'data-bs-placement' => 'top',
            'data-bs-toggle' => 'tooltip-secondary'
        ],
    ],

];
