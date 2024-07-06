<?php

use yii\widgets\DetailView;
use app\modules\dungchung\models\CustomFunc;
/* @var $this yii\web\View */
/* @var $model app\modules\muasam\models\BaoGiaMuaSam */
?>
<div class="bao-gia-mua-sam-view">
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
                            [
                                'attribute'=>'id_phieu_mua_sam',
                                'value'=>function($model){
                                        $html='P'.str_pad($model->id_phieu_mua_sam, 6, '0', STR_PAD_LEFT);;
                                        return $html;
                                    }
                                
                            ],
                            'so_bao_gia',
                            [
                                'attribute'=>'ngay_bao_gia',
                                'value'=>function($model){
                                    $cus = new CustomFunc();
                                    if ($model->ngay_bao_gia != null) {
                                        return $cus->convertYMDToDMY($model->ngay_bao_gia);
                                    }
                                    else return null;
                                }
                            ],
                            [
                                'attribute'=>'ngay_ket_thuc',
                                'value'=>function($model){
                                    $cus = new CustomFunc();
                                    if ($model->ngay_ket_thuc != null) {
                                        return $cus->convertYMDToDMY($model->ngay_ket_thuc);
                                    }
                                    else return null;
                                }
                            ],
                            [
                                'attribute'=>'ngay_gui_bg',
                                'value'=>function($model){
                                    $cus = new CustomFunc();
                                    if ($model->ngay_gui_bg != null) {
                                        return $cus->convertYMDToDMY($model->ngay_gui_bg);
                                    }
                                    else return null;
                                }
                            ],
                            [
                                'attribute'=>'trang_thai',
                                'value'=>function($model){
                                   return $model->getDmTrangThai()[$model->trang_thai];
                                }
                            ],
                            
                            [
                                'attribute'=>'tong_tien',
                                'value'=>function($model){
                                   return number_format($model->tong_tien);
                                }
                            ],
                            'ghi_chu_bg1:ntext',
                            'ghi_chu_bg2:ntext',
                            [
                                'attribute'=>'ngay_tao',
                                'value'=>function($model){
                                    $cus = new CustomFunc();
                                    if ($model->ngay_tao != null) {
                                        return $cus->convertYMDToDMY($model->ngay_tao);
                                    }
                                    else return null;
                                }
                            ],
                            
                            
                            [
                                'attribute'=>'nguoi_tao',
                                'value'=>function($model){
                                   return $model->nguoiTao->username;
                                }
                            ],
                            [
                                'attribute'=>'ngay_cap_nhat',
                                'value'=>function($model){
                                    $cus = new CustomFunc();
                                    if ($model->ngay_cap_nhat != null) {
                                        return $cus->convertYMDToDMY($model->ngay_cap_nhat);
                                    }
                                    else return null;
                                }
                            ],
                           
                            
                            [
                                'attribute'=>'nguoi_cap_nhat',
                                'value'=>function($model){
                                   return $model->nguoiCapNhat->username ?? "";
                                }
                            ],
                            [
                                'attribute'=>'nguoi_duyet_bg',
                                'value'=>function($model){
                                   return $model->nguoiDuyet->username ?? "";
                                }
                            ]
                        ],
                    ]) ?>

                </div>
                <div class="tab-pane" id="tab26" role="tabpanel">
                    <?= $this->render('./../phieu-mua-sam/lich-su-bao-gia', [
                            'model' => $model->phieuMuaSam
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