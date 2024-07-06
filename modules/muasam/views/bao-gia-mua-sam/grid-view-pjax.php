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
/* @var $searchModel app\modules\muasam\models\BaoGiaMuaSamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$isUpdate=$phieuMuaSam->trang_thai=='approved';
?>


<div class="bao-gia-mua-sam-index">
    <div id="ajaxCrudDatatable_bao_gia">
        <?=GridView::widget([
            'id'=>'crud-datatable-bao-gia',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_pjax-columns.php'),
            'toolbar'=> [
                ['content'=>
                    ($isUpdate ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm báo giá', ['/muasam/bao-gia-mua-sam/create','id_phieu_mua_sam'=>$phieuMuaSam->id],
                    ['role'=>'modal-remote-2','title'=> 'Thêm mới báo giá','class'=>'btn btn-outline-primary']) : '')
                    
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
                 'heading' => false,
                // 'before'=>'<em>* Danh sách Bao Gia Mua Sams</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; Gửi báo giá',
                                ["gui-bao-gia",'id_phieu_mua_sam'=>$phieuMuaSam->id] ,
                                [
                                    'class'=>'btn ripple btn-success',
                                    'role'=>'modal-remote-2',
                                    'hidden'=>!$isUpdate ? 'hidden' : false,
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Xác nhận gửi?',
                                    'data-confirm-message'=>'Bạn có chắc muốn gửi tất cả báo giá?'
                                ]),
                        ]).                        
                       '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>

