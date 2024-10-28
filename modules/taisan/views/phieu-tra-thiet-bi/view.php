<?php
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\TsPhieuTraThietBi */
?>
<div class="ts-phieu-tra-thiet-bi-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label'=>'Mã phiếu',
                'value'=>'PT-' . substr("0000000{$model->id}", -6)
            ],
            [
                'attribute' => 'id_nguoi_tra',
                'value' => $model->nguoiTra ? $model->nguoiTra->ten_nhan_vien : '-',
                'label' => 'Người trả',
            ],
            [
                'attribute' => 'id_nguoi_nhan',
                'value' => $model->nguoiNhan ? $model->nguoiNhan->ten_nhan_vien : '-',
                'label' => 'Người nhận',
            ],
            'noi_dung_tra',
            [
                'attribute' => 'created_at',
                'value' => $model->createdAt ? $model->createdAt : '-',
                'label' => 'Ngày tạo',
            ],
            /* [
                'attribute' => 'id_yeu_cau_van_hanh',
                //Số phiếu: P- substr("0000000{$model->id}", -6) ,
                'value' => $model->id_yeu_cau_van_hanh ? 'P-' . substr("0000000{$model->id_yeu_cau_van_hanh}", -6) : '-',
                'label' => 'Thuộc yêu cầu vận hành',
            ], */
            [
                'attribute' => 'nguoi_tao',
                'value' => $model->nguoi_tao!=null?(User::findOne($model->nguoi_tao)->tenNhanVien):'',
            ],
            
        ],
    ]) ?>

    <h3 class="mt-4">Chi tiết</h3>
	
	<?= $this->render('_form_chi_tiet_view', ['model'=>$model, 'modelDetail'=>$model->details]) ?>
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
                'attribute' => 'ngay_tra',
                'value' => function ($model) {
                    return $model->ngayTra ? $model->ngayTra : "";
                }
            ],
        ],
    ])*/ ?>


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
    
    <div class="row">
    	<div class="col-md-12">
            <!-- print phieu -->
            <div style="display:none">
                <div id="print">
                	<?php $this->render('_print_phieu', compact('model')) ?>
                </div>
            </div>
             
             <?php /*if($model->details){?>      
            <a href="#" onClick="InPhieu()" class="btn ripple btn-main-primary"><i class="fa fa-print"></i> In Phiếu (A5, A4)</a>
            <?php } */?>
        </div>
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

<script>
function InPhieu(){
	//load lai phieu in (tranh bi loi khi chinh sua du lieu chua update noi dung in)
	$.ajax({
        type: 'post',
        url: '/taisan/phieu-tra-thiet-bi/get-phieu-tra-thiet-bi-in-ajax?idPhieu=' + <?= $model->id ?>,
        //data: frm.serialize(),
        success: function (data) {
            console.log('Submission was successful.');
            console.log(data);            
            if(data.status == 'success'){
            	$('#print').html(data.content);
            	printPhieu();//call from script.js
            } else {
            	alert('Vật tư không còn tồn tại trên hệ thống!');
            }
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });	
}
</script>