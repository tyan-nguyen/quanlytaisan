<?php

use app\modules\bophan\models\NhanVien;
use app\modules\user\models\User;
use yii\widgets\DetailView;

use yii\helpers\Html;
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
            <!-- LEFT -->
            <div class="col-md-5">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
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
                            'attribute' => 'id_nguoi_gui',
                            'value' => $model->nguoiGui ? $model->nguoiGui->username : '-',
                            'label' => 'Người gửi',
                        ],

                        [
                            'attribute' => 'id_nguoi_duyet',
                            'value' => $model->nguoiDuyet ? $model->nguoiDuyet->username : '-',
                            'label' => 'Người duyệt',
                        ],

                        [
                            'attribute' => 'id_nguoi_xuat',
                            'value' => $model->nguoiXuat ? $model->nguoiXuat->username : '-',
                            'label' => 'Người xuất',
                        ],

                        [
                            'attribute' => 'id_nguoi_nhan',
                            'value' => $model->nguoiNhan ? $model->nguoiNhan->ten_nhan_vien : '-',
                            'label' => 'Người nhận',

                        ],

                        // 'id_bo_phan_quan_ly',
                        'cong_trinh',
                        // 'ngay_lap',
                        [
                            'attribute' => 'ngay_lap',
                            'value' => $model->ngayLap ? $model->ngayLap : '-',
                            'label' => 'Ngày lập',
                        ],
                        // 'ngay_gui',
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
                        // 'noi_dung_gui',
                        // 'noi_dung_duyet',
                        // 'noi_dung_xuat',
                        // 'noi_dung_nhan',
                        'dia_diem',
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

            <!-- RIGHT -->
            <div class="col-md-7">
                <!-- Chi tiet Van hanh -->
                <div class="row">
                    <div class="col">
                    	 <?= $this->render('_form_chi_tiet_view', ['model'=>$model]) ?>
                    	 
                    	 <?php 
                    	 if(isset($model->errors['id'])){
                    	     echo \app\widgets\SummaryAlert::widget([
                    	         'type'=>'danger',
                    	         'textMain'=>'',
                    	         'textSummary'=>$model->errors['id'][0] . '<br/>' . Html::a('<i class="fas fa-pencil-alt"></i> Cập nhật thiết bị', 
                    	             ['/taisan/yeu-cau-van-hanh/update', 'id'=>$model->id],
                    	             [
                    	                 'role'=>'modal-remote',
                    	                 'class'=>'add-item btn btn-primary btn-xs'
                    	             ]
                    	         ),
                    	         'showCloseButton'=>false
                    	     ]);
                    	 }
                    	 ?>
                        <?php /* GridView::widget([
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
                        ]) */ ?>
                    </div>
                </div>
                <!-- ./Chi tiet Van hanh -->
                <hr>

                <div class="row">

                    <?php
                    $hieuLuc = $model->hieu_luc ?? null;
                    $isOperate = true;
                    if ($hieuLuc !== null && $hieuLuc !== 'VANHANH') {
                        $isOperate = false;
                    }
                    ?>

                    <!-- Form-->
                    <div class="col">
                        <?php if ($model->hieu_luc === 'DADUYET' || $model->hieu_luc === 'VANHANH') : ?>
                            <?php $form = ActiveForm::begin([
                                'id' => 'operate-form',
                                'action' => ['yeu-cau-van-hanh/operate', 'id' => $model->id]
                            ]); ?>
                            <div class="row">
                                <div class="col">
                                    <fieldset class="border p-2" style="margin:3px;">
                                        <legend class="legend">
                                            <p>Thông tin người xuất phiếu</p>
                                        </legend>

                                        <?= Html::hiddenInput('hieu_luc', 'VANHANH') ?>

                                        <div class="row">
                                            <div class="col-6">
                                                <?= $form->field($model, 'id_nguoi_xuat')->widget(Select2::classname(), [
                                                    // 'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                                                    'data' => $userList,
                                                    'language' => 'vi',
                                                    'options' => [
                                                        'placeholder' => '- Chọn -',
                                                        'value' => $currentUserId,
                                                        'disabled' => $isOperate
                                                    ],
                                                    'pluginOptions' => [
                                                        'width' => '100%',
                                                        'allowClear' => true
                                                    ],
                                                ]); ?>
                                            </div>
                                            <div class="col-6">
                                                <?= $form->field($model, 'ngay_xuat')->widget(DatePicker::classname(), [
                                                    'options' => [
                                                        'placeholder' => 'Chọn ngày...',
                                                        'class' => 'form-control',
                                                        'value' => date('d/m/Y'),
                                                        'disabled' => $isOperate

                                                    ],
                                                    'pluginOptions' => [
                                                        'width' => '100%',
                                                        'autoclose' => true,
                                                        'format' => 'dd/mm/yyyy',
                                                        'todayHighlight' => true
                                                    ]
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-12">
                                                <?= $form->field($model, 'noi_dung_xuat')->textInput([
                                                    'maxlength' => true,
                                                    'disabled' => $isOperate
                                                ]) ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <fieldset class="border p-2" style="margin:3px;">
                                        <legend class="legend">
                                            <p>Thông tin người nhận</p>
                                        </legend>
                                        <div class="row">
                                            <div class="col-6">
                                                <?= $form->field($model, 'id_nguoi_nhan')->widget(Select2::classname(), [
                                                    'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                                                    'language' => 'vi',
                                                    'options' => [
                                                        'placeholder' => 'Chọn...',
                                                        'value' => $idNguoiYeuCau,
                                                        'disabled' => $isOperate
                                                    ],
                                                    'pluginOptions' => [
                                                        'width' => '100%',
                                                        'allowClear' => true
                                                    ],
                                                ]); ?>
                                            </div>
                                            <div class="col-6">
                                                <?= $form->field($model, 'ngay_nhan')->widget(DatePicker::classname(), [
                                                    'options' => [
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Chọn ngày...',
                                                        'value' => date('d/m/Y'),
                                                        'disabled' => $isOperate

                                                    ],
                                                    'pluginOptions' => [
                                                        'width' => '100%',
                                                        'autoclose' => true,
                                                        'format' => 'dd/mm/yyyy',
                                                        'todayHighlight' => true
                                                    ]
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-12">
                                                <?= $form->field($model, 'noi_dung_nhan')->textInput([
                                                    'maxlength' => true,
                                                    'disabled' => $isOperate
                                                ]) ?>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        <?php endif; ?>
                    </div>
                    <!-- ./Form -->
                </div>

            </div>
        </div>
    </div>
</div>
