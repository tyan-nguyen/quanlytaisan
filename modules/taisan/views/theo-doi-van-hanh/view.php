<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();

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
                        Thông tin khác
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="panel-body tabs-menu-body ps">
        <div class="tab-content">
            <div class="tab-pane  active show" id="tab1" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-striped table-bordered detail-view'],
                            'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
                            'attributes' => [

                                //'id',
                                [
                                    'label'=>'Mã phiếu',
                                    'value'=>'P-' . substr("0000000{$model->id}", -6)
                                ],
                                [
                                    'attribute' => 'id_nguoi_lap',
                                    'value' => $model->nguoiLap ? $model->nguoiLap->ten_nhan_vien : '-',
                                    'label' => 'Người Lập',
                                ],
                                /* [
                                    'attribute' => 'id_nguoi_yeu_cau',
                                    'value' => $model->nguoiYeuCau ? $model->nguoiYeuCau->ten_nhan_vien : '-',
                                    'label' => 'Người yêu cầu',
                                ], */
                                [
                                    'attribute' => 'ngay_lap',
                                    'value' => $model->ngayLap ? $model->ngayLap : '-',
                                    'label' => 'Ngày lập',
                                ],

                                /* [
                                    'attribute' => 'id_nguoi_gui',
                                    'value' => $model->nguoiGui ? $model->nguoiGui->username : '-',
                                    'label' => 'Người gửi',
                                ],
                                [
                                    'attribute' => 'ngay_gui',
                                    'value' => $model->ngayGui ? $model->ngayGui : '-',
                                    'label' => 'Ngày gửi',
                                ],
                                */
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
                                /*[
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
                                ], */

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
                            'template' => "<tr><th style='width: 40%;'>{label}</th><td class='align-middle'>{value}</td></tr>"
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                    	<?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-striped table-bordered detail-view'],
                            'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
                            'attributes' => [

                                //'id',
                                /* [
                                    'label'=>'Mã phiếu',
                                    'value'=>'P-' . substr("0000000{$model->id}", -6)
                                ], */
                                /* [
                                    'attribute' => 'id_nguoi_lap',
                                    'value' => $model->nguoiLap ? $model->nguoiLap->ten_nhan_vien : '-',
                                    'label' => 'Người Lập',
                                ], */
                                [
                                    'attribute' => 'id_nguoi_yeu_cau',
                                    'value' => $model->nguoiYeuCau ? $model->nguoiYeuCau->ten_nhan_vien : '-',
                                    'label' => 'Người yêu cầu',
                                ],
                                /* [
                                    'attribute' => 'ngay_lap',
                                    'value' => $model->ngayLap ? $model->ngayLap : '-',
                                    'label' => 'Ngày lập',
                                ], */

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

                                /* [
                                    'attribute' => 'id_nguoi_duyet',
                                    'value' => $model->nguoiDuyet ? $model->nguoiDuyet->username : '-',
                                    'label' => 'Người duyệt',
                                ],
                                [
                                    'attribute' => 'ngay_duyet',
                                    'value' => $model->ngayDuyet ? $model->ngayDuyet : '-',
                                    'label' => 'Ngày duyệt',
                                ], */
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

                               /*  'dia_diem',
                                'cong_trinh',
                                [
                                    'attribute' => 'hieu_luc',
                                    'value' => $model->tenHieuLucWithBadge ? $model->tenHieuLucWithBadge : '-',
                                    'format' => 'raw',
                                    'label' => 'Hiệu lực',
                                ], */


                            ],
                            'template' => "<tr><th style='width: 40%;'>{label}</th><td class='align-middle'>{value}</td></tr>"
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                    	<h5>Danh sách thiết bị</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên thiết bị</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Ngày trả</th>
                                    <th>Trả về kho</th>
                                    <!-- Other relevant columns -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($modelsDetail as $detail) : ?>
                                    <tr <?= ($detail->id==$idItem?'class="item-bold"':'') ?>>
                                        <td><?= Html::encode($detail->thietBi->ten_thiet_bi) ?></td>
                                        <td><?= Html::encode($cus->convertYMDToDMY($detail->ngay_bat_dau)) ?></td>
                                        <td><?= Html::encode($cus->convertYMDToDMY($detail->ngay_ket_thuc)) ?></td>
                                        
                                        <?php if($detail->phieuTraThietBiChiTiet):?>
                                       <td><?= Html::encode($cus->convertYMDToDMY($detail->ngay_tra_thuc_te)) ?></td>
                                        <td><?= ($detail->phieuTraThietBiChiTiet?
                                        ($detail->phieuTraThietBiChiTiet->tra_khong_ve_kho? 'Còn tại công trình' : 'Đã chuyển về kho')
                                            :'')
                                        ?></td>
                                         <?php else: ?>
                                         <td colspan="2">Chưa trả</td>
                                         <?php endif;?>
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
                    ],
                    'template' => "<tr><th style='width: 30%;'>{label}</th><td class='align-middle'>{value}</td></tr>"
                ])
                ?>
            </div>
        </div>
    </div>
</div>