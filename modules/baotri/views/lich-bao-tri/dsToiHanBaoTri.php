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

CrudAsset::register($this);
?>

<div class="row">
	<div class="col-md-12">
		<div class="card custom-card">
			<div class="card-header rounded-bottom-0">
				<h5 class="mt-3">DANH SÁCH ĐẾN HẠN BẢO TRÌ</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 col-xl-12">
						
                    <?php Pjax::begin([
                        'id'=>'myGrid',
                        'timeout' => 10000,
                        'formSelector' => '.myFilterForm'
                    ]); ?>
                    
                    <div class="lich-su-vat-tu-index">
                        <div id="ajaxCrudDatatable">
                            <?=GridView::widget([
                                'id'=>'crud-datatable',
                                'dataProvider' => $dataProvider,
                                //'filterModel' => $searchModel,
                                'pjax'=>true,
                                'columns' => require(__DIR__.'/_columns-phieu-bao-tri.php'),
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

					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-xl'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
    'footer'=>'',// always need it for jquery plugin
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

