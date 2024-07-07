<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();

/* @var $this yii\web\View */
/* @var $model app\models\YeuCauVanHanh */
?>
<div class="ts-theo-doi-van-hanh-view">

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
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body ps">
            <div class="tab-content">
                <div class="tab-pane  active show" id="tab1" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card custom-card div-600">
                                <div class="card-body">

                                    <div class="text-wrap">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?= DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
                                                        'id' => [
                                                            'attribute' => 'id',
                                                            'value' => 'Phiếu Vận hành #' . $model->id
                                                        ],
                                                        [
                                                            'attribute' => 'id_nguoi_lap',
                                                            'value' => $model->nguoiLap ? $model->nguoiLap->ten_nhan_vien : '-',
                                                            'label' => 'Người lập',
                                                        ],
                                                        [
                                                            'attribute' => 'id_nguoi_yeu_cau',
                                                            'value' => $model->nguoiYeuCau ? ($model->nguoiYeuCau->ten_nhan_vien) : "-",
                                                        ],
                                                        [
                                                            'attribute' => 'id_nguoi_gui',
                                                            'value' => $model->nguoiGui ? ($model->nguoiGui->username) : "-",
                                                        ],
                                                        [
                                                            'attribute' => 'id_nguoi_duyet',
                                                            'value' => $model->nguoiDuyet ? ($model->nguoiDuyet->username) : "-",
                                                        ],
                                                        [
                                                            'attribute' => 'id_nguoi_xuat',
                                                            'value' => $model->nguoiXuat ? ($model->nguoiXuat->username) : "-",
                                                        ],
                                                        [
                                                            'attribute' => 'id_nguoi_nhan',
                                                            'value' => $model->nguoiNhan ? ($model->nguoiNhan->ten_nhan_vien) : "-",
                                                        ],
                                                        'id_bo_phan_quan_ly',
                                                        'cong_trinh',
                                                        [
                                                            'attribute' => 'ngay_lap',
                                                            'value' => $cus->convertYMDToDMY($model->ngay_lap),
                                                        ],
                                                        [
                                                            'attribute' => 'ngay_gui',
                                                            'value' => $cus->convertYMDToDMY($model->ngay_gui),
                                                        ],
                                                        [
                                                            'attribute' => 'ngay_duyet',
                                                            'value' => $cus->convertYMDToDMY($model->ngay_duyet),
                                                        ],
                                                        [
                                                            'attribute' => 'ngay_xuat',
                                                            'value' => $cus->convertYMDToDMY($model->ngay_xuat),
                                                        ],
                                                        [
                                                            'attribute' => 'ngay_nhan',
                                                            'value' => $cus->convertYMDToDMY($model->ngay_nhan),
                                                        ],
                                                        'ly_do',
                                                        'hieu_luc',
                                                        'noi_dung_lap',
                                                        'noi_dung_gui',
                                                        'noi_dung_duyet',
                                                        'noi_dung_xuat',
                                                        'noi_dung_nhan',
                                                        'dia_diem',
                                                        [
                                                            'attribute' => 'created_at',
                                                            'value' => $cus->convertYMDToDMY($model->created_at),
                                                        ],
                                                        [
                                                            'attribute' => 'updated_at',
                                                            'value' => $cus->convertYMDToDMY($model->updated_at),
                                                        ],
                                                        // 'deleted_at',
                                                    ],
                                                ]) ?>
                                            </div>
                                            <div class="col-md-7">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



</div>