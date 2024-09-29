<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset; 
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
$isCheckUpdate=$phieuSuaChua->trang_thai !== 'completed';
//$checkAction=($isCheckUpdate && $baoGiaSuaChua->trang_thai=="draft");

$checkAction=$baoGiaSuaChua && $baoGiaSuaChua->trang_thai=='draft';
?>

<?php Pjax::begin([
    'id'=>'crud-datatable-pjax-bao-gia',
    'timeout' => 10000,
    'formSelector' => '.myFilterForm'
]); ?>
<div class="row">
    <div class="col-4">

        <?=$this->render('../bao-gia-sua-chua/grid-view-pjax', [
        'baoGia' => $baoGiaSuaChua,
        'phieuSuaChua' => $phieuSuaChua,
        'dataProvider' => $dataProviderBgsc,
    ])?>
    </div>
    <div class="col-8">
        <div class="ct-bao-gia-sua-chua-index">
            <div id="ajaxCrudDatatable">
                <?=GridView::widget([
                    'id'=>'crud-datatable',
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'pjax'=>true,
                    'showFooter' => true,
                    'columns' => require(__DIR__.'/_columns.php'),
                    'toolbar'=> [
                        ['content'=>
                        ($checkAction ? Html::a('<i class="fas fa fa-plus" aria-hidden="true"></i> Thêm mới', ['/suachua/ct-bao-gia-sua-chua/create',"id_bao_gia"=>$baoGiaSuaChua->id],
                            ['role'=>'modal-remote','title'=> 'Thêm mới chi tiết báo giá','class'=>'btn btn-outline-primary']) : "").
                            Html::a('<i class="fas fa fa-sync" aria-hidden="true"></i> Tải lại', ['',"id_phieu_sua_chua"=>$phieuSuaChua->id,'id_bao_gia'=>$baoGiaSuaChua ? $baoGiaSuaChua->id : null],
                            ['data-pjax'=>1, 'class'=>'btn btn-outline-primary', 'title'=>'Tải lại','id'=> 'update-gridview-ct']).
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
                        'heading' => $baoGiaSuaChua ? ($baoGiaSuaChua->dvBaoGia->ten_doi_tac ?? '') : '',
                        // 'heading' => '<i class="fas fa fa-list" aria-hidden="true"></i> Danh sách',
                        // 'before'=>'<em>* Danh sách linh kiện/phụ kiện</em>',
                        'after'=>BulkButtonWidget::widget([
                                    'buttons'=>$checkAction ? Html::a('<i class="fas fa fa-trash" aria-hidden="true"></i>&nbsp; Xóa đã chọn',
                                        ["bulkdelete"] ,
                                        [
                                            'class'=>'btn ripple btn-secondary',
                                            'role'=>'modal-remote-bulk',
                                            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                            'data-request-method'=>'post',
                                            'data-confirm-title'=>'Xác nhận xóa?',
                                            'data-confirm-message'=>'Bạn có chắc muốn xóa?'
                                        ]) : '',
                                ]).                        
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

