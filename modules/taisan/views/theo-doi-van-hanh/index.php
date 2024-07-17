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

?>

<style>
    .fc-event-time {
        display: none;
    }

    .fc-list-event-title a {
        cursor: pointer;
    }
</style>


<?php Pjax::begin([
    'id' => 'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ts-theo-doi-van-hanh-index">

    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header rounded-bottom-0">
                <!-- <h5><?= \yii\helpers\Html::encode($this->title) ?></h5> -->
                <h5 class="mt-3">LỊCH ĐIỀU CHUYỂN THIẾT BỊ</h5>
            </div>
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

<?php Pjax::end(); ?>

<?php Modal::begin([
    'options' => [
        'id' => 'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
    ],
    'dialogOptions' => ['class' => 'modal-xl'],
    'closeButton' => ['label' => '<span aria-hidden=\'true\'>×</span>'],
    'id' => 'ajaxCrudModal',
    'footer' => '', // always need it for jquery plugin
]) ?>

<?php Modal::end(); ?>

<?php
// $searchContent = $this->render("_search", ["model" => $searchModel]);
// echo FilterFormWidget::widget(["content" => $searchContent, "description" => "Nhập thông tin tìm kiếm."])
?>

<?php
$eventsUrl = Url::to(['theo-doi-van-hanh/events']);


$script = <<<JS
$(document).ready(function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '$eventsUrl',
        locale: 'vi',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listMonth,switchToList,switchToCalendar'
        },
        views: {
            dayGridMonth: { buttonText: 'Theo tháng' },
            timeGridWeek: { buttonText: 'Theo tuần' }
        },
        customButtons: {
            
        },
        eventClick: function(info) {
            // alert('Device ID: ' + info.event.title);
            info.jsEvent.preventDefault(); // Prevents the browser from following the URL automatically
            // if (info.event.url) {
            //     window.location.href = info.event.url; // Redirect to the request view page
            // }

            var aClick = '<a href="/taisan/theo-doi-van-hanh/view?id='+ info.event.id +'" role="modal-remote">Click</a>';
	        modal.open(aClick, null);

        },
       
    });

    calendar.render();
});
JS;

$this->registerJs($script);
?>