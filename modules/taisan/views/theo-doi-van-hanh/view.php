<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();

/* @var $this yii\web\View */
/* @var $model app\models\YeuCauVanHanh */
?>

<div class="panel panel-primary">

    <div class="tab-menu-heading tab-menu-heading-boxed">
        <div class="tabs-menu-boxed">
            <!-- Tabs -->
            <ul class="nav panel-tabs" role="tablist">
                <li>
                    <a href="#tab1" class="active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                        Thông tin chung
                    </a>
                </li>
                <li>
                    <a href="#tab2" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">
                        Thông tin phụ
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="panel-body tabs-menu-body ps">
        <div class="tab-content">
            <div class="tab-pane  active show" id="tab1" role="tabpanel">
                <div class="row">
                    <div class="col">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-striped table-bordered detail-view'],
                            'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
                            'attributes' => [

                                [
                                    'attribute' => 'id_nguoi_lap',
                                    'value' => $model->nguoiLap ? $model->nguoiLap->ten_nhan_vien : '-',
                                    'label' => 'Người Lập',
                                ],
                                [
                                    'attribute' => 'id_nguoi_yeu_cau',
                                    'value' => $model->nguoiYeuCau ? $model->nguoiYeuCau->ten_nhan_vien : '-',
                                    'label' => 'Người yêu cầu',
                                ],
                                [
                                    'attribute' => 'ngay_lap',
                                    'value' => $model->ngayLap ? $model->ngayLap : '-',
                                    'label' => 'Ngày lập',
                                ],

                                [
                                    'attribute' => 'id_nguoi_gui',
                                    'value' => $model->nguoiGui ? $model->nguoiGui->username : '-',
                                    'label' => 'Người gửi',
                                ],
                                [
                                    'attribute' => 'ngay_gui',
                                    'value' => $model->ngayGui ? $model->ngayGui : '-',
                                    'label' => 'Ngày gửi',
                                ],

                                [
                                    'attribute' => 'id_nguoi_duyet',
                                    'value' => $model->nguoiDuyet ? $model->nguoiDuyet->username : '-',
                                    'label' => 'Người duyệt',
                                ],
                                [
                                    'attribute' => 'ngay_duyet',
                                    'value' => $model->ngayDuyet ? $model->ngayDuyet : '-',
                                    'label' => 'Ngày duyệt',
                                ],
                                [
                                    'attribute' => 'id_nguoi_xuat',
                                    'value' => $model->nguoiXuat ? $model->nguoiXuat->username : '-',
                                    'label' => 'Người xuất',
                                ],
                                [
                                    'attribute' => 'ngay_xuat',
                                    'value' => $model->ngayXuat ? $model->ngayXuat : '-',
                                    'label' => 'Ngày xuất',
                                ],

                                [
                                    'attribute' => 'id_nguoi_nhan',
                                    'value' => $model->nguoiNhan ? $model->nguoiNhan->ten_nhan_vien : '-',
                                    'label' => 'Người nhận',
                                ],
                                [
                                    'attribute' => 'ngay_nhan',
                                    'value' => $model->ngayNhan ? $model->ngayNhan : '-',
                                    'label' => 'Ngày nhận',
                                ],

                                // 'id_bo_phan_quan_ly',

                                'dia_diem',
                                'cong_trinh',
                                [
                                    'attribute' => 'hieu_luc',
                                    'value' => $model->tenHieuLucWithBadge ? $model->tenHieuLucWithBadge : '-',
                                    'format' => 'raw',
                                    'label' => 'Hiệu lực',
                                ],


                            ],
                        ]) ?>
                    </div>
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên thiết bị</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <!-- Other relevant columns -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($modelsDetail as $detail) : ?>
                                    <tr>
                                        <td><?= Html::encode($detail->thietBi->ten_thiet_bi) ?></td>
                                        <td><?= Html::encode($cus->convertYMDToDMY($detail->ngay_bat_dau)) ?></td>
                                        <td><?= Html::encode($cus->convertYMDToDMY($detail->ngay_ket_thuc)) ?></td>
                                        <!-- Other relevant data -->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab2" role="tabpanel">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'noi_dung_lap',
                        'ly_do',
                        'noi_dung_gui',
                        'noi_dung_duyet',
                        'noi_dung_xuat',
                        'noi_dung_nhan',
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>