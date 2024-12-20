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
use app\modules\dungchung\models\CustomFunc;

$custom = new CustomFunc();

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

<div class="ts-phe-duyet-yeu-cau-van-hanh-view">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'id_nguoi_lap',
                            'value' => $model->nguoiLap ? $model->nguoiLap->ten_nhan_vien : '-',
                            'label' => 'Người lập',
                        ],

                        [
                            'attribute' => 'id_nguoi_duyet',
                            'value' => $model->nguoiDuyet ? $model->nguoiDuyet->username : '-',
                            'label' => 'Người duyệt',
                        ],
                        // 'id_nguoi_xuat', 
                        // 'id_nguoi_nhan',
                        // 'id_nguoi_yeu_cau',
                        // 'id_bo_phan_quan_ly',
                        // 'ngay_xuat',
                        // 'ngay_nhan',
                        [
                            'attribute' => 'ngay_duyet',
                            'value' => $custom->convertYMDHISToDMY($model->ngay_duyet),
                        ],
                        [
                            'attribute' => 'ngay_lap',
                            'value' => $custom->convertYMDHISToDMY($model->ngay_lap),
                        ],
                        'ly_do',
                        // 'hieu_luc',
                        [
                            'attribute' => 'hieu_luc',
                            'value' => $model->tenHieuLuc ? $model->tenHieuLuc : '-',
                            'label' => 'Hiệu lực',
                        ],
                        'noi_dung_lap',
                        'dia_diem',
                        'cong_trinh',

                        [
                            'attribute' => 'created_at',
                            'value' => $model->createdAt ? $custom->convertYMDHISToDMY($model->createdAt) : '-',
                            'label' => 'Ngày tạo',
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value' => $model->updatedAt ? $custom->convertYMDHISToDMY($model->updatedAt) : '-',
                            'label' => 'Ngày cập nhật',
                        ],
                    ],
                ]) ?>
            </div>

            <div class="col-md-7">

                <div class="row">
                    <?php /* GridView::widget([
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

                    ])*/ ?>
                </div>

                <hr>

                <div class="row mt-4">
                    <div class="col">
                        <?php
                        $hieuLuc = $model->hieu_luc ?? null;
                        $isPending = true;
                        if ($hieuLuc !== null && $hieuLuc !== 'CHODUYET') {
                            $isPending = false;
                        }
                        //if ($model->hieu_luc === 'CHODUYET') : 
                        ?>
                        <fieldset class="border p-2" style="margin:3px;">
                            <legend class="legend">
                                <p>Thông tin gửi phiếu
                                    <span class="badge bg-default float-end">
                                        @<?= Yii::$app->user->identity->username ?>
                                    </span>
                                </p>
                            </legend>
                            <div class="approval-form">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'approve-form',
                                    'action' => [
                                        'phe-duyet-yeu-cau-van-hanh/approve',
                                        'id' => $model->id,
                                    ],
                                    'options' => ['data' => ['pjax' => true]],
                                ]); ?>

                                <?= Html::hiddenInput('hieu_luc', 'DADUYET', ['id' => 'hieu-luc-hidden-input']) ?>


                                <?= $form->field($model, 'id_nguoi_duyet')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
                                <?= $form->field($model, 'ngay_duyet')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>

                                <div class="row">
                                    <div class="col-12">
                                        <?= $form->field($model, 'noi_dung_duyet')->textarea(['rows' => 2, 'readonly' => !$isPending]) ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <?php ActiveForm::end(); ?>

                        <?php //endif; 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setStatusAndSubmit(status) {
        var statusInput = document.getElementById('hieu-luc-hidden-input');

        console.log("status: " + status);

        if (statusInput) {
            statusInput.value = status;
            console.log("\nstatusInput.value =  " + statusInput.value);

            var form = document.getElementById('approve-form');
            var formData = new FormData(form);

            // Submit the form using AJAX
            $.ajax({
                url: form.action,
                type: form.method,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        console.log('Data saved successfully');
                        $('#ajaxCrudModal').modal('hide');
                        $.pjax.reload({
                            container: '#crud-datatable-pjax'
                        });
                    } else {
                        console.error('Failed to save data:', response.errors);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX request failed:', textStatus, errorThrown);
                }
            });
        } else {
            console.error('Status hidden input not found');
        }
    }

    $(document).on('submit', '#approve-form', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#ajaxCrudModal').modal('hide');
                    $.pjax.reload({
                        container: '#crud-datatable-pjax'
                    });
                } else {
                    console.error('Failed to save data:', response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX request failed:', textStatus, errorThrown);
            }
        });
    });
</script>