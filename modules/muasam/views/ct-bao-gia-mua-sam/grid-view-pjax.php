<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset; 
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
use app\widgets\FilterFormWidget;
use app\modules\muasam\models\BaoGiaMuaSam;
use app\widgets\forms\DocumentWidget;
use app\widgets\forms\ImageWidget;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\muasam\models\CtBaoGiaMuaSamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



CrudAsset::register($this);

$isUpdate=$model && $model->trang_thai=='draft';

?>

<?php Pjax::begin([
    'id'=>'crud-datatable-pjax-bao-gia',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>

<div class="row">
    <div class="col-4">
    
    <?= $this->render('../bao-gia-mua-sam/grid-view-pjax', [
        'baoGia' => $model,
        'phieuMuaSam'=>$phieuMuaSam,
        'dataProvider' => $dataProviderBgms
    ]) ?>
</div>
    <div class="col-8">
        <div class="ct-bao-gia-mua-sam-index">
            <div id="ajaxCrudDatatable1">

    
                <?=GridView::widget([
            'id'=>'crud-datatable-ct-bao-gia',
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                ($isUpdate ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới', ['/muasam/ct-bao-gia-mua-sam/create','id_bao_gia'=>$model->id],
                    ['role'=>'modal-remote-2','title'=> 'Thêm thiết bị cần mua sắm','class'=>'btn btn-outline-primary']) : '').
                    (Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['','id_phieu_mua_sam'=>$phieuMuaSam->id,'id_bao_gia'=>$model ? $model->id : null],
                    ['data-pjax'=>1, 'class'=>'btn btn-outline-primary', 'title'=>'Tải lại','id'=> 'update-gridview-ct'])).
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
                'heading' => $model ? ($model->dvBaoGia->ten_doi_tac ?? '') : '',
                //'before'=>'<em>* Danh sách Ct Bao Gia Mua Sams</em>',
                // 'after'=>$isUpdate ? BulkButtonWidget::widget([
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
                //         ]) : ''.                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<<JS
$(document).ready(function() {
    function updateUrl(param) {
        var link3 = $('#update-gridview-ct');
        var currentUrl = link3.attr('href');

        // Remove any existing param B1 from the URL
        currentUrl = currentUrl.replace(/(\?|&)id_bao_gia=[^&]*/, '');

        // Check if there are other query parameters in the URL
        if (currentUrl.indexOf('?') !== -1) {
            // If there are, append the new param with &
            var newUrl = currentUrl + '&id_bao_gia=' + param;
        } else {
            // If not, append the new param with ?
            var newUrl = currentUrl + '?id_bao_gia=' + param;
        }

        // Update the href attribute of link3
        link3.attr('href', newUrl);
    }

    $('.update-gridview').on('click', function(e) {
        e.preventDefault();

        // Get the data-param value from the clicked link
        var param = $(this).data('param');

        // Update link3 with the new param
        updateUrl(param);
        $('#update-gridview-ct').click();
        // Console log to check the updated URL
        //console.log('Updated URL for link3:', $('#link3').attr('href'));
    });
});
JS;
$this->registerJs($script);
?>
<?php Pjax::end(); ?>


