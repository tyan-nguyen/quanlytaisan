<?php

use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TsPhieuTraThietBi */
?>
<div class="ts-phieu-tra-thiet-bi-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'id_nguoi_tra',
                'value' => $model->nguoiTra ? $model->nguoiTra->ten_nhan_vien : '-',
                'label' => 'Người Trả',
            ],
            'noi_dung_tra',
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
            'ngay_tra',

        ],
    ]) ?>


    <div class="row">
        <?php if ($model->hieu_luc === 'NHAP') : ?>
            <?php $form = ActiveForm::begin([
                'id' => 'confirm-form',
                'action' => [
                    'phieu-tra-thiet-bi/view',
                    'id' => $model->id,
                    'method' => 'post',
                    'options' => ['data-pjax' => true, 'class' => 'form-ajax'],
                ],
            ]); ?>
            <?= Html::hiddenInput('hieu_luc', 'DATRA') ?>
            <?php ActiveForm::end(); ?>
        <?php endif; ?>
    </div>
</div>

<?php
// $script = <<< JS
// $(document).on('beforeSubmit', '#confirm-form', function (e) {
//     e.preventDefault();
//     var form = $(this);
    
//     $.ajax({
//         type: form.attr('method'),
//         url: form.attr('action'),
//         data: form.serialize(),
//         success: function (response) {
//             if (response.success) {
//                 $('#ajaxCrudModal').modal('hide');
//                 window.location.href = response.redirectUrl;
//             } else {
//                 alert(response.message);
//             }
//         },
//         error: function () {
//             alert('An error occurred. Please try again.');
//         }
//     });
    
//     return false; // Prevent default form submission
// });

// JS;
// $this->registerJs($script);
?>

