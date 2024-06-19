<?php

use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset;
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
use app\widgets\FilterFormWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\taisan\models\TheoDoiVanHanhSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Theo dõi vận hành thiết bị';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;

?>

<style>
    .fc-event-time {
        display: none;
    }
</style>


<?php Pjax::begin([
    'id' => 'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ts-yeu-cau-van-hanh-index">

    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header rounded-bottom-0">
                <!-- <h5 class="mt-3">List Calendar</h5> -->
                <h5><?= \yii\helpers\Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    <div id="ajaxCrudDatatable">
        <?php 
        // GridView::widget([
        //     'id' => 'crud-datatable',
        //     'dataProvider' => $dataProvider,
        //     //'filterModel' => $searchModel,
        //     'pjax' => true,
        //     'columns' => require(__DIR__ . '/_columns.php'),
        //     'toolbar' => [
        //         [
        //             'content' =>
        //             Html::a(
        //                 '<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới',
        //                 ['create'],
        //                 ['role' => 'modal-remote', 'title' => 'Thêm mới Ts Yeu Cau Van Hanhs', 'class' => 'btn btn-outline-primary']
        //             ) .
        //                 Html::a(
        //                     '<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại',
        //                     [''],
        //                     ['data-pjax' => 1, 'class' => 'btn btn-outline-primary', 'title' => 'Tải lại']
        //                 ) .
        //                 //'{toggleData}'.
        //                 '{export}'
        //         ],
        //     ],
        //     'striped' => false,
        //     'condensed' => true,
        //     'responsive' => true,
        //     'panelHeadingTemplate' => '{title}',
        //     'panelFooterTemplate' => '{summary}',
        //     'summary' => 'Hiển thị dữ liệu {count}/{totalCount}, Trang {page}/{pageCount}',
        //     'panel' => [
        //         //'type' => 'primary', 
        //         'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Danh sách',
        //         'before' => '<em>* Danh sách Ts Yeu Cau Van Hanhs</em>',
        //         'after' => BulkButtonWidget::widget([
        //             'buttons' => Html::a(
        //                 '<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
        //                 ["bulkdelete"],
        //                 [
        //                     'class' => 'btn ripple btn-secondary',
        //                     'role' => 'modal-remote-bulk',
        //                     'data-confirm' => false, 'data-method' => false, // for overide yii data api
        //                     'data-request-method' => 'post',
        //                     'data-confirm-title' => 'Xác nhận xóa?',
        //                     'data-confirm-message' => 'Bạn có chắc muốn xóa?'
        //                 ]
        //             ),
        //         ]) .
        //             '<div class="clearfix"></div>',
        //     ]
        // ]) 
        ?>
    </div>
</div>

<?php Pjax::end(); ?>

<?php Modal::begin([
    'options' => [
        'id' => 'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
    ],
    'dialogOptions' => ['class' => 'modal-lg'],
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
$eventsUrl = Url::to(['yeu-cau-van-hanh/events']);

$script = <<<JS
$(document).ready(function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '$eventsUrl',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventClick: function(info) {
            // alert('Device ID: ' + info.event.title);
            info.jsEvent.preventDefault(); // Prevents the browser from following the URL automatically
            if (info.event.url) {
                window.location.href = info.event.url; // Redirect to the request view page
            }
        }
    });
    calendar.render();
});
JS;

$this->registerJs($script);
?>