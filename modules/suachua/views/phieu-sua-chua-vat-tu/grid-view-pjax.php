<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset; 
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;

$isCheckUpdate = $phieuSuaChua->trang_thai !== 'completed';
$enableEdit = ($phieuSuaChua->duyet_vt_kho == 'draft' || $phieuSuaChua->duyet_vt_kho == 'draft_reject');
?>
<?php Pjax::begin([
    'id'=>'crud-datatable-pjax-vat-tu',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="phieu-sua-chua-vat-tu-index">
    <div id="ajaxCrudDatatable1">
        <?=GridView::widget([
            'id'=>'crud-datatable1',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    ( ($isCheckUpdate && $enableEdit) ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới', ['/suachua/phieu-sua-chua-vat-tu/create',"phieu_sua_chua"=>$phieuSuaChua->id],
                    ['role'=>'modal-remote-2','title'=> 'Thêm mới vật tư vào phiếu sửa chữa','class'=>'btn btn-outline-primary']) : '').
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
                'heading' => '<i class="ion-clipboard"></i> Trạng thái: <span class="' .
                    ($phieuSuaChua->duyet_vt_kho == 'draft_reject' ? 'text-secondary' : '') 
                .'">' . $phieuSuaChua->trangThaiKho . '</span>',
                //'before'=>'<em></em>',
                //'heading'=>false,
                'after'=>BulkButtonWidget::widget([
                        'buttons'=> ($isCheckUpdate && $enableEdit) ? Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
                                ['bulkdelete'],
                                [
                                    'class'=>'btn ripple btn-secondary',
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Xác nhận xóa?',
                                    'data-confirm-message'=>'Bạn có chắc muốn xóa?'
                                ]) : '',
                        ]).
                ($phieuSuaChua->duyet_vt_kho=='draft'?Html::a('Gửi yêu cầu duyệt vật tư', ['/suachua/phieu-sua-chua/update','id'=>$phieuSuaChua->id], [
                            'class' => 'btn btn-warning',
                            'style'=>"margin-left:5px",
                            'data' => [
                                'method' => 'post',
                                'params'=>['PhieuSuaChua[duyet_vt_kho]'=>'draft_sent'],
                            ],
                            //'role'=>'modal-remote-3',
                            'data-confirm' => 'Bạn có chắc muốn gửi yêu cầu duyệt vật tư kho?',
                            //'data-confirm-title'=>'Gửi yêu cầu',
                            //'data-confirm-message'=>'Xác nhận gửi yêu cầu'
                        ]) : '' )
                .($phieuSuaChua->duyet_vt_kho=='draft_reject'?Html::a('Gửi lại yêu cầu duyệt vật tư', ['/suachua/phieu-sua-chua/update','id'=>$phieuSuaChua->id], [
                    'class' => 'btn btn-warning',
                    'style'=>"margin-left:5px",
                    'data' => [
                        'method' => 'post',
                        'params'=>['PhieuSuaChua[duyet_vt_kho]'=>'draft_sent'],
                    ],
                    //'role'=>'modal-remote-3',
                    'data-confirm' => 'Bạn có chắc muốn gửi lại yêu cầu duyệt vật tư kho?',
                    //'data-confirm-title'=>'Gửi yêu cầu',
                    //'data-confirm-message'=>'Xác nhận gửi yêu cầu'
                ]) : '' )
                
                        .'<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>

<?php Pjax::end(); ?>

