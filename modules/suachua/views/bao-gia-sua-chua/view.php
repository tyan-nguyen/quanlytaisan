<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\suachua\models\BaoGiaSuaChua */
?>
<div class="row bao-gia-sua-chua-view">

    <div class="card-body">
        <div class="panel panel-primary">
            <div class="tab-menu-heading">
                <div class="tabs-menu1">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs" role="tablist">

                        <li><a href="#tab25" class="active" data-bs-toggle="tab" aria-selected="true" role="tab">
                                Thông tin vật tư
                            </a></li>
                        <li><a href="#tab26" data-bs-toggle="tab" aria-selected="false" role="tab" class=""
                                tabindex="-1">Lịch sử báo giá</a></li>


                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body ps">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab25" role="tabpanel">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'id_phieu_sua_chua',
                            'so_bao_gia',
                            'flag_index',
                            'ngay_bao_gia',
                            'ngay_ket_thuc',
                            'ngay_gui_bg',
                            'trang_thai',
                            'phi_linh_kien',
                            'phi_khac',
                            'tong_tien',
                            'ghi_chu_bg1:ntext',
                            'ghi_chu_bg2:ntext',
                            'ngay_tao',
                            'nguoi_tao',
                            'ngay_cap_nhat',
                            'nguoi_cap_nhat',
                            'nguoi_duyet_bg',
                        ],
                    ]) ?>

                    </div>
                    <div class="tab-pane" id="tab26" role="tabpanel">
                    <?= $this->render('./../phieu-sua-chua/lich-su-bao-gia', [
                            'model' => $model->phieuSuaChua
                        ]) ?>
                    </div>


                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
        </div>
    </div>



    

</div>
