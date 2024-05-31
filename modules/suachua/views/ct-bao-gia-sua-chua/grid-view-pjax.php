<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset; 
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
$isCheckUpdate=$phieuSuaChua->trang_thai !== 'completed';
$checkAction=($isCheckUpdate && $baoGiaSuaChua->trang_thai=="draft");


?>

<?php Pjax::begin([
    'id'=>'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ct-bao-gia-sua-chua-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'showFooter' => true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                ($checkAction ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới', ['/suachua/ct-bao-gia-sua-chua/create',"id_bao_gia"=>$baoGiaSuaChua->id],
                    ['role'=>'modal-remote','title'=> 'Thêm mới chi tiết báo giá','class'=>'btn btn-outline-primary']) : "").
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['',"id_phieu_sua_chua"=>$baoGiaSuaChua->id_phieu_sua_chua],
                    ['data-pjax'=>1, 'class'=>'btn btn-outline-primary', 'title'=>'Tải lại']).
                    //'{toggleData}'.
                    '{export}'.($checkAction ? var_dump($checkAction) : "")
                ],
            ],          
            'striped' => false,
            'condensed' => true,
            'responsive' => true,
            'panelHeadingTemplate'=>'{title}',
            'panelFooterTemplate'=>'{summary}',
            'summary'=>'Hiển thị dữ liệu {count}/{totalCount}, Trang {page}/{pageCount}',          
            'panel' => [
                //'type' => 'primary', 
                'heading'=>false,
                // 'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Danh sách',
                // 'before'=>'<em>* Danh sách linh kiện/phụ kiện</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>$checkAction ? Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
                                ["bulkdelete"] ,
                                [
                                    'class'=>'btn ripple btn-secondary',
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Xác nhận xóa?',
                                    'data-confirm-message'=>'Bạn có chắc muốn xóa?'
                                ]) : '',
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>

<?php Pjax::end(); ?>

