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
                        'ngay_duyet',
                        'ngay_lap',
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

<div id="print-yeu-cau-van-hanh-content" class="print-yeu-cau-van-hanh-content">
</div>

<script>
    function setStatusAndSubmit(status) {
        var statusInput = document.getElementById('hieu-luc-hidden-input');
        if (statusInput) {
            statusInput.value = status;
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
                        window.location.href = response.redirectUrl;
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
</script>


<?php
$js = <<< JS
$(document).ready(function() {
    var modelId = '{$model->id}';
    console.log(modelId);
    $('#print-button').on('click', function() {
        $.ajax({
            url: '/taisan/phe-duyet-yeu-cau-van-hanh/print-view?id='+ modelId,
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