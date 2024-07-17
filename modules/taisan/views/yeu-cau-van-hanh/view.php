<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\TsYeuCauVanHanh */
?>

<style>
    .legend {
        font-size: 14px;
        font-weight: bold;
        margin: 0px;
        padding: 0px;
    }
</style>

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
                    <!-- Left -->
                    <div class="col">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-striped table-bordered detail-view'],
                            'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
                            'attributes' => [

                                'id',
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

                    <!-- Right -->
                    <div class="col">
                        <div class="row">
                            <?= GridView::widget([
                                'dataProvider' => new ArrayDataProvider([
                                    'allModels' => $modelsDetail,
                                    'pagination' => [
                                        'pageSize' => 10,
                                    ],
                                ]),
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'id_thiet_bi',
                                        'value' => function ($model) {
                                            return $model->thietBi ? $model->thietBi->ten_thiet_bi : "";
                                        }
                                    ],
                                    [
                                        'attribute' => 'ngay_bat_dau',
                                        'value' => function ($modelsDetail) {
                                            return $modelsDetail->ngayBatDau ? $modelsDetail->ngayBatDau : "";
                                        }
                                    ],
                                    [
                                        'attribute' => 'ngay_ket_thuc',
                                        'value' => function ($modelsDetail) {
                                            return $modelsDetail->ngayKetThuc ? $modelsDetail->ngayKetThuc : "";
                                        }
                                    ],
                                ],
                                'summary' => ''
                            ]) ?>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row mt-4">
                                    <div class="col">
                                        <?php if ($model->hieu_luc === '') : ?>
                                            <fieldset class="border p-2" style="margin:3px;">
                                                <legend class="legend">
                                                    <p>Thông tin người gửi phiếu
                                                        <span class="badge bg-default float-end">
                                                            @<?= Yii::$app->user->identity->username ?>
                                                        </span>
                                                    </p>
                                                </legend>
                                                <div class="approval-form">
                                                    <?php $form = ActiveForm::begin([
                                                        'id' => 'send-request-form',
                                                        'action' => [
                                                            'yeu-cau-van-hanh/send-request',
                                                            'id' => $model->id
                                                        ],
                                                    ]); ?>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <?= $form->field($model, 'noi_dung_gui')->textarea(['col' => 2, 'readonly' => true]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php ActiveForm::end(); ?>
                                            </fieldset>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
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
                        // [
                        //     'attribute' => 'created_at',
                        //     'value' => $model->createdAt ? $model->createdAt : '-',
                        //     'label' => 'Ngày tạo',
                        // ],
                        // [
                        //     'attribute' => 'updated_at',
                        //     'value' => $model->updatedAt ? $model->updatedAt : '-',
                        //     'label' => 'Ngày cập nhật',
                        // ],
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>


<!-- <div class="ts-yeu-cau-van-hanh-view">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
            </div>
        </div>
    </div>
</div> -->
<!-- </div> -->


<div id="print-yeu-cau-van-hanh-content" class="print-yeu-cau-van-hanh-content">
</div>

<?php

$js = <<< JS
$(document).ready(function() {
    console.log("hello");
    // $("#print").click(function(){
    //     $('.print-yeu-cau-van-hanh').printThis();
    // });

    var modelId = '{$model->id}';
    console.log(modelId);
    $('#print-button').on('click', function() {
        $.ajax({
            url: '/taisan/yeu-cau-van-hanh/print-view?id='+ modelId,
            type: 'GET',
            success: function(data) {
                $('#print-yeu-cau-van-hanh-content').html(data);
                $('.print-yeu-cau-van-hanh').printThis();
            },
            error: function() {
                alert('Đã xảy ra lỗi trong khi tải nội dung.');
            }
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);

?>

<?php
$this->registerJsFile("@web/assets/plugins/tabs/jquery.multipurpose_tabcontent.js", [
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
$this->registerJsFile("@web/assets/plugins/tabs/tab-content.js", [
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
?>