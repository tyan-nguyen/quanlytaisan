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
/* @var $searchModel app\modules\kholuutru\models\LichSuVatTuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



//CrudAsset::register($this);



?>

<?php Pjax::begin([
    'id'=>'crud_datatable_ajax_lich_su',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="lich-su-vat-tu-index">
    <div id="ajaxCrudDatatableLichSu">
        <?=GridView::widget([
            'id'=>'crud-datatable-lich-su',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns-lich-su-sua-chua.php'),
            'toolbar'=> [
                ['content'=>
                    
                   
                    
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
                //'before'=>'<em>* Danh sách Lich Su Vat Tus</em>',
                                       
                        '<div class="clearfix"></div>',
            ]       
            
        ])?>
    </div>
</div>

<?php Pjax::end(); ?>

