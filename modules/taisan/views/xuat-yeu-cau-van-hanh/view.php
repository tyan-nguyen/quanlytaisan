<?php

use app\modules\bophan\models\NhanVien;
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
            <div class="col-md-6">

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
                            'value' => $model->nguoiGui ? $model->nguoiGui->ten_nhan_vien : '-',
                            'label' => 'Người gửi',

                        ],

                        [
                            'attribute' => 'id_nguoi_duyet',
                            'value' => $model->nguoiDuyet ? $model->nguoiDuyet->ten_nhan_vien : '-',
                            'label' => 'Người duyệt',

                        ],

                        [
                            'attribute' => 'id_nguoi_xuat',
                            'value' => $model->nguoiXuat ? $model->nguoiXuat->ten_nhan_vien : '-',
                            'label' => 'Người xuất',

                        ],

                        [
                            'attribute' => 'id_nguoi_nhan',
                            'value' => $model->nguoiNhan ? $model->nguoiNhan->ten_nhan_vien : '-',
                            'label' => 'Người nhận',

                        ],

                        // 'id_bo_phan_quan_ly',
                        'cong_trinh',
                        'ngay_lap',
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
                        'created_at',
                        'updated_at',
                    ],
                ]) ?>
            </div>

            <div class="col-md-6">
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
                        'ngay_bat_dau',
                        'ngay_ket_thuc',

                    ],
                ]) ?>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <?php if ($model->hieu_luc === 'DADUYET') : ?>

                    <?php $form = ActiveForm::begin(['action' => ['xuat-yeu-cau-van-hanh/operate', 'id' => $model->id]]); ?>
                    <div class="row">

                        <div class="col-6">
                            <fieldset class="border p-2" style="margin:3px;">
                                <legend class="legend">
                                    <p>Thông tin người xuất phiếu</p>
                                </legend>
                                <div class="row">
                                    <div class="col-6">
                                        <?= $form->field($model, 'id_nguoi_xuat')->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                                            'language' => 'vi',
                                            'options' => ['placeholder' => 'Chọn...'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]); ?>
                                    </div>
                                    <div class="col-6">
                                        <?= $form->field($model, 'ngay_xuat')->widget(DatePicker::classname(), [
                                            'options' => [
                                                'placeholder' => 'Chọn ngày...'
                                            ],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd/mm/yyyy',
                                                'todayHighlight' => true
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-12">
                                        <?= $form->field($model, 'noi_dung_xuat')->textInput(['maxlength' => true]) ?>
                                    </div>

                                </div>
                            </fieldset>
                        </div>


                        <div class="col-6">
                            <fieldset class="border p-2" style="margin:3px;">
                                <legend class="legend">
                                    <p>Thông tin người nhận</p>
                                </legend>
                                <div class="row">
                                    <div class="col-6">
                                        <?= $form->field($model, 'id_nguoi_nhan')->widget(Select2::classname(), [
                                            'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                                            'language' => 'vi',
                                            'options' => ['placeholder' => 'Chọn...'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]); ?>
                                    </div>
                                    <div class="col-6">
                                        <?= $form->field($model, 'ngay_nhan')->widget(DatePicker::classname(), [
                                            'options' => [
                                                'placeholder' => 'Chọn ngày...'
                                            ],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd/mm/yyyy',
                                                'todayHighlight' => true
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                    <div class="col-12">
                                        <?= $form->field($model, 'noi_dung_nhan')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <?= Html::submitButton('Xuất phiếu', [
                                'class' => 'btn btn-success float-end',
                                'data' => [
                                    'method' => 'post',
                                    'params' => [
                                        'hieu_luc' => 'VANHANH',
                                    ],
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>

                <?php endif; ?>
            </div>

        </div>
    </div>

</div>