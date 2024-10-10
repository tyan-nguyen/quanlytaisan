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
/* @var $searchModel app\modules\muasam\models\CtPhieuNhapHangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


//CrudAsset::register($this);


?>

<?php Pjax::begin([
    'id'=>'crud-datatable-pjax-phieu-nhap',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ct-phieu-nhap-hang-index">
    <div id="ajaxCrudDatatable2">
        <?=GridView::widget([
            'id'=>'crud-datatable2',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['','id_phieu_mua_sam'=>$model->id],
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
                //'before'=>'<em>* Danh sách Ct Phieu Nhap Hangs</em>',
                // 'after'=>BulkButtonWidget::widget([
                //             'buttons'=>Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
                //                 ["bulkdelete"] ,
                //                 [
                //                     'class'=>'btn ripple btn-secondary',
                //                     'role'=>'modal-remote-bulk',
                //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                //                     'data-request-method'=>'post',
                //                     'data-confirm-title'=>'Xác nhận xóa?',
                //                     'data-confirm-message'=>'Bạn có chắc muốn xóa?'
                //                 ]),
                //         ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>

<?php Pjax::end(); ?>

