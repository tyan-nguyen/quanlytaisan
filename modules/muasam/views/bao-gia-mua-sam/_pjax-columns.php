<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;
use yii\bootstrap5\Html;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_dv_bao_gia',
        'format'=>'raw',
        'value'=>function($model){
            $dv=$model->dvBaoGia;
            $tenDv=$dv ? $dv->ten_doi_tac : '--';
            $html=Html::a($tenDv, ['#'],
            ['title'=>$tenDv,'class'=>'update-gridview text-primary','data-param' => $model->id]);
            $html.='</br><span
                class="badge rounded-pill bg-'. $model->getColorTrangThai()[$model->trang_thai].'">'.$model->getDmTrangThai()[$model->trang_thai].'</span>';
            return $html;
        }
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'visible'=>$isUpdate,
        'width' => '50px',
        'template'=>'{delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(['/muasam/bao-gia-mua-sam/'.$action,'id'=>$key]);
        },
        'deleteOptions'=>['role'=>'modal-remote-2','title'=>'Xóa dữ liệu này', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Xác nhận xóa dữ liệu?',
                          'data-confirm-message'=>'Bạn có chắc chắn thực hiện hành động này?',
                           'class'=>'btn ripple btn-secondary btn-sm',
                           'data-bs-placement'=>'top',
                           'data-bs-toggle'=>'tooltip-secondary'], 
    ],

];   