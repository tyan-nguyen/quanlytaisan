<?php

use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset;
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
use app\widgets\FilterFormWidget;
use app\modules\taisan\models\PhieuTraThietBi;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\taisan\models\PhieuTraThietBiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phiếu trả thiết bị';
$this->params['breadcrumbs'][] = $this->title;

//CrudAsset::register($this);

Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;

?>

<?php Pjax::begin([
    'id' => 'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ts-phieu-tra-thiet-bi-index">
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
                        ['role' => 'modal-remote', 'title' => 'Thêm mới Ts Phieu Tra Thiet Bis', 'class' => 'btn btn-outline-primary']
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
                'before' => 'Danh sách Phiếu trả thiết bị',
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
                            'data-confirm-message' => 'Lưu ý: Dữ liệu liên quan phiếu này sẽ bị xóa theo và không thể phục hồi. Bạn có chắc chắn thực hiện hành động này?'
                        ]
                    ),
                ]) .
                    '<div class="clearfix"></div>',
            ]
        ]) ?>
    </div>
</div>

<?php Pjax::end(); ?>

<?php Modal::begin([
    'options' => [
        'id' => 'ajaxCrudModal',
        // 'tabindex' => false // important for Select2 to work properly
        'data-bs-backdrop' => 'static',
        'data-bs-keyboard' => 'false',
        'tabindex' => '-1'
    ],
    'dialogOptions' => ['class' => 'modal-xl'],
    'closeButton' => ['label' => '<span aria-hidden=\'true\'>×</span>'],
    'id' => 'ajaxCrudModal',
    'footer' => '', // always need it for jquery plugin
]) ?>

<?php Modal::end(); ?>

<?php
$searchContent = $this->render("_search", ["model" => $searchModel]);
echo FilterFormWidget::widget(["content" => $searchContent, "description" => "Nhập thông tin tìm kiếm."])
?>

