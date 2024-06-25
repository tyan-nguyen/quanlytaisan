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
/* @var $searchModel app\modules\muasam\models\CtBaoGiaMuaSamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



CrudAsset::register($this);

$isUpdate=$model->trang_thai=='draft';

?>

<?php Pjax::begin([
    'id'=>'crud-datatable-pjax-bao-gia',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ct-bao-gia-mua-sam-index">
    <div id="ajaxCrudDatatable1">
        <?=GridView::widget([
            'id'=>'crud-datatable1',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                ($isUpdate ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới', ['/muasam/ct-bao-gia-mua-sam/create','id_bao_gia'=>$model->id],
                    ['role'=>'modal-remote-2','title'=> 'Thêm mới Ct Bao Gia Mua Sams','class'=>'btn btn-outline-primary']) : '').
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['','id_phieu_mua_sam'=>$model->id_phieu_mua_sam],
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
                'heading' => false,
                //'before'=>'<em>* Danh sách Ct Bao Gia Mua Sams</em>',
                'after'=>$isUpdate ? BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
                                ["bulkdelete"] ,
                                [
                                    'class'=>'btn ripple btn-secondary',
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Xác nhận xóa?',
                                    'data-confirm-message'=>'Bạn có chắc muốn xóa?'
                                ]),
                        ]) : ''.                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>

<?php Pjax::end(); ?>

