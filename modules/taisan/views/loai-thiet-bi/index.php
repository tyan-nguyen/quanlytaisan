<?php
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use app\widgets\FilterFormWidget;
use cangak\ajaxcrud\CrudAsset; 
use cangak\ajaxcrud\BulkButtonWidget;
use app\modules\taisan\models\LoaiThietBi;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\taisan\models\LoaiThietBiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loại thiết bị';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;
Yii::$app->params['showImport'] = true;
Yii::$app->params['showImportDownload'] = Yii::getAlias('@web/uploads/excel/down/mau_import_loai_thiet_bi.xlsx');
Yii::$app->params['showImportModel'] = LoaiThietBi::MODEL_ID;
?>

<?php Pjax::begin([
    'id'=>'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="loai-thiet-bi-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới', ['create'],
                    ['role'=>'modal-remote','title'=> 'Loại thiết bị','class'=>'btn btn-outline-primary']).
                    Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-outline-primary', 'title'=>'Tải danh sách']).
                    '{export}'
                ],
            ],          
            'striped' => false,
            'condensed' => true,
            'responsive' => true,  
            'panelHeadingTemplate'=>'{title}',
            'panelFooterTemplate'=>'<div class="row"><div class="col-md-8">{pager}</div><div class="col-md-4">{summary}</div></div>',
            'summary'=>'Hiển thị dữ liệu {count}/{totalCount}, Trang {page}/{pageCount}',      
            'panel' => [
                //'type' => 'primary', 
                'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Loại Tài sản/Thiết bị',
                'before'=>'Danh sách loại Tài sản/Thiết bị',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xoá dòng chọn',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-danger btn-xs",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Thông báo',
                                    'data-confirm-message'=>'Bạn có muốn xoá dòng chọn không?'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Pjax::end(); ?>
<?php Modal::begin([
   "options" => [
    "id"=>"ajaxCrudModal",
    "tabindex" => false // important for Select2 to work properly
],
    'closeButton'=>['label'=>'<span aria-hidden="true">×</span>'],
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
<?php
    $searchContent = $this->render("_search", ["model" => $searchModel]);
    echo FilterFormWidget::widget(["content"=>$searchContent, "description"=>"Nhập thông tin tìm kiếm."]) 
?>
