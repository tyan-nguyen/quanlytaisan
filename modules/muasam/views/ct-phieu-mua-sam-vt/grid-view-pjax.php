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
/* @var $searchModel app\modules\muasam\models\CtPhieuMuaSamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



//CrudAsset::register($this);

$isUpdate=$model->trang_thai=='draft';
?>

<?php Pjax::begin([
    'id'=>'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ct-phieu-mua-sam-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                ($isUpdate ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới', ['/muasam/ct-phieu-mua-sam-vt/create','id_phieu_mua_sam'=>$model->id],
                    ['role'=>'modal-remote','title'=> 'Thêm vật tư','class'=>'btn btn-outline-primary']) : "").
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam','id_phieu_mua_sam'=>$model->id],
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
                //'before'=>'<em>* Danh sách Ct Phieu Mua Sams</em>',
                'after'=>($isUpdate ? BulkButtonWidget::widget([
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
                        ]) : "").                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>

<?php Pjax::end(); ?>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-lg'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
    'footer'=>'',// always need it for jquery plugin
])?>

<?php Modal::end(); ?>
