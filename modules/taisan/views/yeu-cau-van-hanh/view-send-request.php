<?php


use app\modules\bophan\models\NhanVien;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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
            <div class="col-md-5">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id',
                        [
                            'attribute' => 'id_nguoi_lap',
                            'value' => $model->nguoiLap ? $model->nguoiLap->ten_nhan_vien : '-',
                            'label' => 'Người lập',
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
                        [
                            'attribute' => 'created_at',
                            'value' => $model->createdAt ? $model->createdAt : '-',
                            'label' => 'Ngày tạo',
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value' => $model->updatedAt ? $model->updatedAt : '-',
                            'label' => 'Ngày cập nhật',
                        ],
                    ],
                ]) ?>
            </div>

            <div class="col-md-7">
                <div class="row">
                    <div class="col">
                        <?= GridView::widget([
                            'dataProvider' => new ArrayDataProvider([
                                'allModels' => $modelsDetail,
                                'pagination' => [
                                    'pageSize' => 10,
                                ],
                            ]),
                            'summary' => false,
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
                        ]) ?>
                    </div>
                </div>

                <hr>

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
                                                    'yeu-cau-van-hanh/view-send-request',
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
                                                <!-- <div class="col-6"> -->
                                                <?php
                                                // $form->field($model, 'id_nguoi_gui')->widget(Select2::classname(), [
                                                //     'data' => ArrayHelper::map(  NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                                                //     'language' => 'vi',
                                                //     'options' => ['placeholder' => 'Chọn...'],
                                                //     'pluginOptions' => [
                                                //         'allowClear' => true
                                                //     ],
                                                // ]); 
                                                ?>
                                                <!-- </div> -->
                                                <!-- <div class="col-6"> -->
                                                <?php
                                                //  $form->field($model, 'ngay_gui')->widget(DatePicker::classname(), [
                                                //     'options' => [
                                                //         'placeholder' => 'Chọn ngày...'
                                                //     ],
                                                //     'pluginOptions' => [
                                                //         'autoclose' => true,
                                                //         'format' => 'dd/mm/yyyy',
                                                //         'todayHighlight' => true
                                                //     ]
                                                // ]);
                                                ?>
                                                <!-- </div> -->
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-6">
                                                    <?php
                                                    //  Html::submitButton('Send', [
                                                    //     'class' => 'btn btn-success float-end',
                                                    //     'data' => [
                                                    //         'method' => 'post',
                                                    //         'params' => [
                                                    //             'hieu_luc' => 'CHODUYET',
                                                    //         ],
                                                    //     ],
                                                    // ]) 
                                                    ?>
                                                </div>
                                            </div> -->

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