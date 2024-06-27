<?php

use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset;
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
use app\widgets\FilterFormWidget;
use app\modules\taisan\models\YeuCauVanHanh;

// use wbraganca\dynamicform\DynamicFormWidget;
// use wbraganca\dynamicform\DynamicFormAsset;

// DynamicFormAsset::register($this);


/* @var $this yii\web\View */
/* @var $searchModel app\modules\taisan\models\YeuCauVanHanhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phiếu Yêu cầu vận hành';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;

?>

<?php Pjax::begin([
    'id' => 'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ts-yeu-cau-van-hanh-index">
    <div id="ajaxCrudDatatable">
        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                [
                    'content' =>
                    Html::a(
                        '<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới',
                        ['create'],
                        ['role' => 'modal-remote', 'title' => 'Thêm mới Phiếu yêu cầu', 'class' => 'btn btn-outline-primary']
                    ) .
                        Html::a(
                            '<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại',
                            [''],
                            ['data-pjax' => 1, 'class' => 'btn btn-outline-primary', 'title' => 'Tải lại']
                        ) .
                        //'{toggleData}'.
                        '{export}'
                ],
            ],
            'striped' => false,
            'condensed' => true,
            'responsive' => true,
            'panelHeadingTemplate' => '{title}',
            'panelFooterTemplate' => '{summary}',
            'summary' => 'Hiển thị dữ liệu {count}/{totalCount}, Trang {page}/{pageCount}',
            'panel' => [
                //'type' => 'primary', 
                'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Danh sách',
                'before' => 'Danh sách Phiếu yêu cầu',
                'after' => BulkButtonWidget::widget([
                    'buttons' => Html::a(
                        '<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
                        ["bulkdelete"],
                        [
                            'class' => 'btn ripple btn-secondary',
                            'role' => 'modal-remote-bulk',
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => 'Xác nhận xóa?',
                            'data-confirm-message' => 'Bạn có chắc muốn xóa?'
                        ]
                    ),
                ]) .
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
    </div>
</div>

<?php Pjax::end(); ?>


<?php
// $this->registerJs("
// var requestId = $('#dynamic-form').data('request-id');
// console.log('Submit button clicked. Request ID:', requestId);
// $('#draft-button').on('click', function() {
//     var requestId = $('#dynamic-form').data('request-id');
//     console.log('Submit button clicked. Request ID:', requestId);
// if (requestId) {
//     $.ajax({
//         url: '" . \yii\helpers\Url::to(['controller/submit', 'id' => '']) . "' + requestId,
//         type: 'POST',
//         success: function(response) {
//             console.log('Server response:', response);
//             if(response === 'success') {
//                 $('#dynamic-form :input').prop('disabled', true);
//                 $('#submit-button').prop('disabled', true);
//                 $('#update-button').hide();
//             } else {
//                 alert('Error: ' + response);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.log('AJAX error:', status, error);
//             alert('Error: ' + error);
//         }
//     });
// } else {
//     alert('Request ID is not set. Cannot submit the form.');
// }
// });
// ", \yii\web\View::POS_END);
?>



<?php Modal::begin([
    'options' => [
        'id' => 'ajaxCrudModal',
        // 'tabindex' => false, // important for Select2 to work properly
        'data-bs-backdrop' => 'static',
        'data-bs-keyboard' => 'false',
        'tabindex' => '-1'
    ],
    'dialogOptions' => [
        'class' => 'modal-xl',

    ],
    'closeButton' => ['label' => '<span aria-hidden=\'true\'>×</span>'],
    'id' => 'ajaxCrudModal',
    'footer' => '', // always need it for jquery plugin
]) ?>

<?php Modal::end(); ?>

<?php
$searchContent = $this->render("_search", ["model" => $searchModel]);
echo FilterFormWidget::widget(["content" => $searchContent, "description" => "Nhập thông tin tìm kiếm."])


?>

<?php
$sendRequestUrl = Url::to(['yeu-cau-van-hanh/view-send-request']);

$script = <<< JS
$(document).on('click', '#send-request-button', function() {
    var requestId = $(this).data('id');
    console.log(requestId);
// 
    $.ajax({
        url:'$sendRequestUrl',
        type:'get',
        data: {id: requestId},
        success: function(data) {
            $('#ajaxCrudModal .modal-title').html(data.title);
            $('#ajaxCrudModal .modal-body').html(data.content);
            $('#ajaxCrudModal .modal-footer').html(data.footer);
            $('#ajaxCrudModal').modal('show');
        } 
    });
 });
JS;
$this->registerJs($script);
?>

