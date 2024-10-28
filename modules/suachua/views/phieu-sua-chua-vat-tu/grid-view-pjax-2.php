<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset; 
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

$isCheckUpdate=$phieuSuaChua->trang_thai !== 'completed';
 
?>
<?php Pjax::begin([
    'id'=>'crud-datatable-pjax-vat-tu-2',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="phieu-sua-chua-vat-tu-index">
    <div id="ajaxCrudDatatable_vat_tu_2">
        <?=GridView::widget([
            'id'=>'crud-datatable-vat-tu-2',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns-2.php'),
            'toolbar'=> [
                ['content'=>
                ($isCheckUpdate ? (
                    Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm VT hỏng', ['/suachua/phieu-sua-chua-vat-tu/create-from-thiet-bi',"phieu_sua_chua"=>$phieuSuaChua->id],
                        ['role'=>'modal-remote-2','title'=> 'Thêm mới vật tư hỏng từ thiết bị','class'=>'btn btn-outline-primary']) 
                    .Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm VT hỏng khác', ['/suachua/phieu-sua-chua-vat-tu/create2',"phieu_sua_chua"=>$phieuSuaChua->id],
                    ['role'=>'modal-remote-2','title'=> 'Thêm mới vật tư hỏng khác','class'=>'btn btn-outline-primary']) 
                    ): '').
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['',"id_phieu_sua_chua"=>$phieuSuaChua->id],
                    ['data-pjax'=>1, 'class'=>'btn btn-outline-primary', 'title'=>'Tải lại']).
                    //'{toggleData}'.
                    '{export}'
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
                //'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Danh sách',
                //'before'=>'<em></em>',
                'heading'=>false,
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>$isCheckUpdate ? Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
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

