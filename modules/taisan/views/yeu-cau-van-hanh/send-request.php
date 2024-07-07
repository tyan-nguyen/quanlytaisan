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
<div class="ts-yeu-cau-van-hanh-view">

    <div class="container-fluid">
        <div class="row">

            <!-- Left -->
            <div class="col-md-5">
                <?= DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table table-striped table-bordered detail-view'],
                    // 'template' => '<tr><td>{label}</td></tr><tr><td>{value}</td></tr>',
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
                        // 'id_nguoi_duyet',
                        // 'id_nguoi_xuat',
                        // 'id_nguoi_nhan',
                        // 'id_nguoi_yeu_cau',
                        // 'id_bo_phan_quan_ly',
                        // 'ngay_duyet',
                        // 'ngay_xuat',
                        // 'ngay_nhan',
                        'ly_do',
                        [
                            'attribute' => 'hieu_luc',
                            'value' => $model->tenHieuLucWithBadge ? $model->tenHieuLucWithBadge : '-',
                            'format' => 'raw',
                            'label' => 'Hiệu lực',
                        ],
                        'noi_dung_lap',
                        'dia_diem',
                        'cong_trinh',

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
                    ],
                ]) ?>
            </div>

            <!-- Right Col -->
            <div class="col-md-7">
                <div class="row">
                    <div class="col">
                        <!-- <h3 class="mt-4">Chi tiết</h3> -->
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
                </div>

                <div class="row">
                    <div class="col">
                        <div class="row mt-4">
                            <div class="col">

                                <?php if ($model->hieu_luc === 'NHAP') : ?>
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
                                                // 'enableAjaxValidation' => true,
                                                // 'validationUrl' => ['yeu-cau-van-hanh/validate-send-request', 'id' => $model->id],
                                            ]); ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <?= $form->field($model, 'noi_dung_gui')->textarea(['col' => 2]) ?>
                                                </div>
                                                <div class="col-6">
                                                    <?= $form->field($model, 'id_nguoi_gui')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
                                                    <?= $form->field($model, 'ngay_gui')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>
                                                    <?= Html::hiddenInput('hieu_luc', 'CHODUYET') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                            </div>
                            </fieldset>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>