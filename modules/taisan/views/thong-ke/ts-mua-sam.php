<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset;
use cangak\ajaxcrud\BulkButtonWidget;
use app\widgets\FilterFormWidget;
use yii\widgets\Pjax;
use app\modules\taisan\models\ThietBi;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TsThietBiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách vật tư/tài sản';
$this->params['breadcrumbs'][] = $this->title;

//CrudAsset::register($this);
Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;
Yii::$app->params['showImport'] = false;
	    
$conditionShowTree = ($tsLayout>0 && $tsLayout<=3);
$tree = $conditionShowTree==true ? $this->render('_tree', ["model" => $searchModel, 'tsLayout'=>$tsLayout]):0;
?>

<style>
.btn-toolbar ul{
    padding:10px;
}
</style>

<div class="row">
	<?php if($conditionShowTree==true):?>
    <div class="col-md-4">
    	<?= $tree ?>
    </div>
    <?php endif; ?>
	<div class="col-md-<?= $conditionShowTree==true?'8':'12'?>">
	
<?php Pjax::begin([
    'id'=>'myGrid',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="ts-thiet-bi-index">


	
    <div id="ajaxCrudDatatable">
    
    <?php 
    $exp = ExportMenu::widget([
        
        'columnBatchToggleSettings'=>['label'=>'Tất cả'],
        
        'dropdownOptions' =>
        [
            'label' => 'Xuất dữ liệu',
            'class' => 'btn btn-wkm'
        ],
        
        'columnSelectorOptions'=>
        [
            'label' => 'Chọn dữ liệu',
            'class' => 'btn btn-default dropdown-toggle',
            'scrollable'=> true,
        ],
        
        'columnSelectorMenuOptions' =>
        [
            'class' => 'dropdown-menu scrollable-menu',
            'role'=> 'menu'
        ],
        
        'dataProvider' => $dataProvider,
        'columns' => require(__DIR__.'/ts-mua-sam-columns.php'),
        
        'exportConfig' =>
        [
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_EXCEL => false,
            ExportMenu::FORMAT_PDF => false,
            
            ExportMenu::FORMAT_EXCEL_X =>
            [
                'label' => 'EXCEL',
            ]
        ],
        
        'container'=>['class'=>'btn-group pull-left', 'style'=> 'margin: 5px']
    ]);
    ?>	

        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/ts-mua-sam-columns.php'),
            'toolbar'=> [
                ['content'=>
                    /* Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', [Yii::$app->controller->action->id . '?layout='.$tsLayout],
                    ['data-pjax'=>1, 'class'=>'btn btn-default btn-outline-secondary', 'title'=>'Tải lại',
                        'style'=>'padding:0;margin:0'
                    ]) . */
                    //'{export}' 
                    $exp
                ],
            ], 
            'striped' => false,
            'condensed' => true,
            'responsive' => true,   
            'panelHeadingTemplate'=>'{title}',
            'panelFooterTemplate'=>'<div class="row"><div class="col-md-8">{pager}</div><div class="col-md-4">{summary}</div></div>',
            'summary'=>'Hiển thị dữ liệu {count}/{totalCount}, Trang {page}/{pageCount}',  
            /* 'panelTemplate'=>'<div class="panel {type}">
                {panelHeading}
                {panelBefore}
                ' . 
                    ($tsLayout == null ?
                        '{items}'
                        : '<div class="row"><div class="col-md-3">'.$tree.'</div><div class="col-md-9">{items}</div></div>'
                    )
                .'{panelAfter}
                {panelFooter}
            </div>', */
            'panel' => [
                //'type' => 'primary', 
                'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Tài sản/Thiết bị',
                'before'=>'Danh sách Tài sản/Thiết bị',
                'after'=>'<div class="clearfix"></div>',
            ],
            'exportConfig' => [
                GridView::EXCEL =>[
                    'filename' => 'DanhSachTaiSanExport'
                ], 
                
            ],
            //'options' => [ 'style' => 'table-layout:fixed;' ],
        ])?>
    </div><!-- #ajaxCrudDatatable -->
    
</div>

</div> <!-- col-md-8 -->

</div> <!-- row -->
<?php Pjax::end(); ?>
<?php Modal::begin([
   "options" => [
    "id"=>"ajaxCrudModal",
    "tabindex" =>false // important for Select2 to work properly
],
   "id"=>"ajaxCrudModal",
   "dialogOptions"=>["class"=>"modal-xl"],
   "closeButton"=>['label'=>'<span aria-hidden="true">×</span>'],
   "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php Modal::begin([
    'options' => [
            'id'=>'ajaxCrudModal2',
            'tabindex' => false // important for Select2 to work properly
    ],
    'dialogOptions'=>['class'=>'modal-lg'],
    'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
    'id'=>'ajaxCrudModal2',
    'footer'=>'',// always need it for jquery plugin
    ]) ?>
<?php Modal::end(); ?>

<?php
    $searchContent = $this->render("ts-mua-sam-search", ["model" => $searchModel]);
    echo FilterFormWidget::widget(["content"=>$searchContent, "description"=>"Nhập thông tin tìm kiếm."]) 
?>

<?php 
$this->registerJsFile("@web/assets/plugins/treeview/treeview.js",[
/*     'depends' => [
        \yii\web\JqueryAsset::className()
    ], */
    'position' => \yii\web\View::POS_END
]);
?>

<?php
$script = <<< JS
    function treeHeThong(){
        
    }
JS;
$this->registerJs($script);
?>