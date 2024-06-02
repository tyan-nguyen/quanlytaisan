<?php

use app\modules\dungchung\models\CustomFunc;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\modules\kholuutru\models\DmVatTu */
?>
<div class="dm-vat-tu-view">
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
                                tabindex="-1">Lịch sử thay đổi</a></li>


                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body ps">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab25" role="tabpanel">
                        <?=DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'ten_vat_tu',
                            'so_luong',
                            'kho.ten_kho',
                            'don_vi_tinh',

                            [
                                'attribute' => 'trang_thai',
                                'value' => function ($model) {
                                    return $model->dmTrangThai[$model->trang_thai];
                                },
                            ],
                            [
                                'attribute' => 'don_gia',
                                'value' => function ($model) {
                                    return number_format($model->don_gia);
                                },
                            ],
                            [
                                'attribute' => 'ngay_tao',
                                'value' => function ($model) {
                                    $cus = new CustomFunc();
                                    if ($model->ngay_tao != null) {
                                        return $cus->convertYMDToDMY($model->ngay_tao);
                                    } else {
                                        return null;
                                    }

                                },
                            ],
                            [
                                'attribute' => 'nguoi_tao',
                                'value' => function ($model) {
                                    return $model->nguoiTao->username ?? "";
                                },
                            ],
                        ],
                    ])?>

                    </div>
                    <div class="tab-pane" id="tab26" role="tabpanel">
                    <?= $this->render('lich-su-vat-tu', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            //"phieuSuaChua"=>$phieuSuaChua
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