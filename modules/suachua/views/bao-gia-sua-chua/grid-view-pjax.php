<?php
use cangak\ajaxcrud\BulkButtonWidget;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\suachua\models\BaoGiaSuaChuaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$isUpdate = $phieuSuaChua->trang_thai == 'new' || $phieuSuaChua->trang_thai == 'quote_sent' ;
?>


<div class="bao-gia-sua-chua-index">
    <div id="ajaxCrudDatatable_bao_gia">
        <?=GridView::widget([
            'id' => 'crud-datatable-bao-gia',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require (__DIR__ . '/_pjax-columns.php'),
            'toolbar' => [
                ['content' =>
                    ($isUpdate ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm báo giá', ['/suachua/bao-gia-sua-chua/create', 'id_phieu_sua_chua' => $phieuSuaChua->id],
                        ['role' => 'modal-remote-3', 'title' => 'Thêm mới báo giá', 'class' => 'btn btn-outline-primary']) : '') .
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['', 'id_phieu_sua_chua' => $phieuSuaChua->id],
                        ['data-pjax' => 1, 'class' => 'btn btn-outline-primary', 'title' => 'Tải lại', 'id' => 'update-gridview-bg']),

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
                'heading' => false,
                // 'before'=>'<em>* Danh sách Bao Gia Sua Chuas</em>',
                'after' => BulkButtonWidget::widget([
                    'buttons' => Html::a('<i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Gửi báo giá',
                        ["gui-bao-gia", 'id_phieu_sua_chua' => $phieuSuaChua->id],
                        [
                            'class' => 'btn ripple btn-success',
                            'role' => 'modal-remote-2',
                            'hidden' => !$isUpdate ? 'hidden' : false,
                            'data-confirm' => false, 'data-method' => false, // for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => 'Xác nhận gửi?',
                            'data-confirm-message' => 'Bạn có chắc muốn gửi tất cả báo giá?',
                        ]),
                ]) .
                '<div class="clearfix"></div>',
            ],
        ])?>
    </div>
</div>
    

