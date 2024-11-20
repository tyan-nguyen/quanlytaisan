<?php

use yii\widgets\DetailView;
use app\widgets\views\ImageListWidget;
use app\widgets\views\DocumentListWidget;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\taisan\models\ThietBi;
use app\modules\dungchung\models\History;
use yii\helpers\Html;
use app\widgets\views\ImageWithButtonWidget;
/* @var $this yii\web\View */
/* @var $model app\models\TsThietBi */
?>
<div class="ts-thiet-bi-view">

    <div class="panel panel-primary">
        <div class="tab-menu-heading tab-menu-heading-boxed">
            <div class="tabs-menu-boxed">
                <!-- Tabs -->
                <ul class="nav panel-tabs" role="tablist">
                    <li><a href="#tab1" class="active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                            Thông tin thiết bị
                        </a></li>
                    <li><a href="#tab2" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                            Thông tin quản lý
                        </a></li>
                    <li><a href="#tab7" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                            Vật tư/Phụ tùng
                        </a></li>
                    <li><a href="#tab3" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                            Tài liệu
                        </a></li>
                    <li><a href="#tab4" data-bs-toggle="tab" aria-selected="true" role="tab">
                            Lịch sử thay đổi
                        </a></li>
                    <li><a href="#tab5" data-bs-toggle="tab" aria-selected="true" role="tab">
                            Lịch sử sửa chữa
                        </a></li>
                    <li><a href="#tab6" data-bs-toggle="tab" aria-selected="true" role="tab">
                            Lịch sử bảo trì
                        </a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body tabs-menu-body ps">
            <div class="tab-content">
                <div class="tab-pane active show" id="tab1" role="tabpanel">
                    <div class="row">
                        <div class="col-md-8">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [

                                    'ma_thiet_bi',
                                    'ten_thiet_bi',
                                    [
                                        'attribute' => 'trang_thai',
                                        'format' => 'raw',
                                        'value' => $model->tenTrangThaiWithBadge
                                    ],
                                    [
                                        'attribute' => 'id_loai_thiet_bi',
                                        'value' => $model->tenLoaiThietBi
                                    ],
                                    [
                                        'attribute' => 'id_bo_phan_quan_ly',
                                        'value' => $model->tenBoPhanQuanLy
                                    ],
                                    [
                                        'attribute' => 'id_nguoi_quan_ly',
                                        'value' => $model->tenNguoiQuanLy
                                    ],
                                    [
                                        'attribute' => 'id_thiet_bi_cha',
                                        'value' => $model->tenThietBiCha
                                    ],
                                    'nam_san_xuat',
                                    'serial',
                                    'model',
                                    'xuat_xu',
                                    [
                                        'attribute' => 'id_hang_bao_hanh',
                                        'value' => $model->tenHangBaoHanh
                                    ],
                                    'dac_tinh_ky_thuat:ntext',
                                    'ghi_chu:ntext',
                                ],
                                'template' => "<tr><th style='width: 40%;'>{label}</th><td>{value}</td></tr>"
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <div class="card custom-card">
                                <div class="card-body h-100 text-center">
                                    <div>
                                        <h6 class="card-title mb-1">QR CODE</h6>
                                    </div>
                                    <div>
                                        <?= Html::img($model->qrCode, ['width' => 100]) ?>
                                    </div>
                                    <div style="margin-top:20px">
                                        <button type="button" onClick="printQr()" class="btn ripple btn-success btn-sm btn-block">In Mã QR</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card custom-card">
                                <div class="card-body h-100">
                                    <div>
                                        <h6 class="card-title mb-1">Hình ảnh</h6>
                                    </div>
                                    <?= ImageListWidget::widget([
                                        'loai' => ThietBi::MODEL_ID,
                                        'id_tham_chieu' => $model->id
                                    ]) ?>
                                </div>
                            </div>

                            <div class="card custom-card">
                                <div class="card-body h-100">
                                    <div>
                                        <h6 class="card-title mb-1">Trạng thái điều chuyển</h6>
                                        <?php if ($model->trang_thai === 'VANHANH' && $requestDetails != null) : ?>

                                            <?php foreach ($requestDetails as $detail) : ?>
                                                <?= DetailView::widget([
                                                    'model' => $detail,
                                                    'options' => ['class' => 'table table-borderless detail-view'],
                                                    'attributes' => [
                                                        [
                                                            'attribute' => 'yeuCauVanHanh.tenHieuLucWithBadge',
                                                            'value' => $detail->yeuCauVanHanh->tenHieuLucWithBadge ? $detail->yeuCauVanHanh->tenHieuLucWithBadge : '-',
                                                            'format' => 'raw',
                                                            'label' => 'Hiệu lực',

                                                        ],
                                                        [
                                                            'attribute' => 'yeuCauVanHanh.dia_diem',
                                                            'value' => $detail->yeuCauVanHanh->dia_diem ? $detail->yeuCauVanHanh->dia_diem : '-',
                                                            'label' => 'Địa điểm',

                                                        ],
                                                        [
                                                            'attribute' => 'yeuCauVanHanh.cong_trinh',
                                                            'value' => $detail->yeuCauVanHanh->cong_trinh ? $detail->yeuCauVanHanh->cong_trinh : '-',
                                                            'label' => 'Công trình',

                                                        ],
                                                    ],
                                                ]) ?>
                                            <?php endforeach; ?>
                                            <?php elseif ($model->trang_thai == 'VANHANH' && $requestDetails == null):?>
                                            <span class="badge bg-primary">Đang vận hành không theo quy trình</span>
                                        <?php else : ?>
                                            <span class="badge bg-primary">Đang rảnh</span>
                                            <?php /////////////// check phieu cuoi cung xem o kho hay o cong trinh
                                                if($model->lastActivity()){
                                                    echo ('<br/>Vị trí: '. $model->lastActivity());
                                                } else {
                                                    echo ('<br/>Vị trí: Mặc định');
                                                }
                                            ?>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div><!-- col 6 -->
                    </div><!-- row -->
                </div>

                <div class="tab-pane" id="tab2" role="tabpanel">
                    <div class="row">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute' => 'id_vi_tri',
                                    'value' => $model->tenViTri
                                ],
                                [
                                    'attribute' => 'id_he_thong',
                                    'value' => $model->tenHeThong
                                ],
                                //'id_layout',
                                //'id_nhien_lieu',
                                //'id_lop_hu_hong',
                                [
                                    'attribute' => 'id_trung_tam_chi_phi',
                                    'value' => $model->tenTrungTamChiPhi
                                ],
                                [
                                    'attribute' => 'id_don_vi_bao_tri',
                                    'value' => $model->tenBoPhanBaoTri
                                ],
                                [
                                    'attribute' => 'ngay_mua',
                                    'value' => $model->ngayMua
                                ],
                                [
                                    'attribute' => 'han_bao_hanh',
                                    'value' => $model->hanBaoHanh
                                ],
                                [
                                    'attribute' => 'ngay_dua_vao_su_dung',
                                    'value' => $model->ngayDuaVaoSuDung
                                ],
                                [
                                    'attribute' => 'ngay_ngung_hoat_dong',
                                    'value' => $model->ngayNgungHoatDong
                                ],
                                [
                                    'attribute' => 'id_kho',
                                    'value' => ($model->khoLuuTru?$model->khoLuuTru->ten_kho:'')
                                ],
                            ],
                            'template' => "<tr><th style='width: 40%;'>{label}</th><td>{value}</td></tr>"
                        ]) ?>
                    </div>
                </div>

                <div class="tab-pane" id="tab3" role="tabpanel">
                    <div class="row">
                        <?= DocumentListWidget::widget([
                            'loai' => ThietBi::MODEL_ID,
                            'id_tham_chieu' => $model->id
                        ])  ?>
                    </div>
                </div>

                <div class="tab-pane" id="tab4" role="tabpanel">
                    <?= History::showHistory(ThietBi::MODEL_ID, $model->id) ?>
                </div>
                <div class="tab-pane" id="tab5" role="tabpanel">
                    <?= $this->render('lich-su-sua-chua', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        //"phieuSuaChua"=>$phieuSuaChua
                    ]) ?>
                </div>
                <div class="tab-pane" id="tab6" role="tabpanel">
                    <?= $this->render('lich-su-bao-tri', [
                        'searchModel' => $searchModelBaoTri,
                        'dataProvider' => $dataProviderBaoTri,
                    ]) ?>
                </div>
                <div class="tab-pane" id="tab7" role="tabpanel">
                	<div id="chiTietBlock">
                    <?= $this->render('_form_ds_vat_tu', [
                        'model'=>$model
                    ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display:none">
        <div id="print">
            <?= $this->render('../qr/_print_qr', compact('model')) ?>
        </div>
    </div>

</div>