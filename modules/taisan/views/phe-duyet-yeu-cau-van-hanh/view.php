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
<div class="ts-yeu-cau-van-hanh-view">

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
                'value' => $model->nguoiDuyet ? $model->nguoiDuyet->ten_nhan_vien : '-',
                'label' => 'Người duyệt',
            ],

            // 'id_nguoi_duyet',
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

            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h3 class="mt-4">Chi tiết</h3>

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
            'ngay_bat_dau',
            'ngay_ket_thuc',

        ],
    ]) ?>

    <!-- phe duyet -->

    <?php if ($model->hieu_luc === 'CHODUYET') : ?>
        <div class="approval-form">
            <?php $form = ActiveForm::begin(['action' => ['phe-duyet-yeu-cau-van-hanh/approve', 'id' => $model->id]]); ?>


            <?= $form->field($model, 'id_nguoi_duyet')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(NhanVien::find()->all(), 'id', 'ten_nhan_vien'),
                'language' => 'vi',
                'options' => ['placeholder' => 'Chọn...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>


            <?= $form->field($model, 'ngay_duyet')->widget(DatePicker::classname(), [
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

            <?= $form->field($model, 'noi_dung_duyet')->textInput(['maxlength' => true]) ?>

            <?= Html::submitButton('Phê duyệt', [
                'class' => 'btn btn-success',
                'data' => [
                    'method' => 'post',
                    'params' => [
                        'hieu_luc' => 'DADUYET',
                    ],
                ],
            ]) ?>

        </div>
        <?php ActiveForm::end(); ?>

    <?php endif; ?>
</div>