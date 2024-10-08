<?php
use yii\helpers\Url;
use app\modules\dungchung\models\CustomFunc;
use yii\bootstrap5\Html;
use app\widgets\views\StatusWithIconWidget;

return [
    
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'width' => '30px',
        'header'=>'',
        'template'=>'{updatePhieu}',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','title'=>'Xem thông tin',
            'class'=>'btn ripple btn-primary btn-sm',
            'data-bs-placement'=>'top',
            'data-bs-toggle'=>'tooltip-primary'],
        'buttons'=>[
            'updatePhieu'=>function ($url, $model) {
            return Html::a('<i class="icon icon-pencil"></i>', ['/baotri/phieu-bao-tri/update','id'=>$model->id],
                    ['data-pjax'=>0,'title'=> 'Chi tiết phiếu bảo trì', 'class'=>"btn ripple btn-info btn-sm", 'role'=>'modal-remote']);
            }
         ],
      ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
        'label'=>'Phiếu bảo trì',
        'format'=>'raw',
        'value'=>function($model){
            $phieuBaoTriLabel = 'Phiếu bảo trì #' . $model->id;
            return Html::a($phieuBaoTriLabel, ['/baotri/phieu-bao-tri/view','id'=>$model->id],
                ['data-pjax'=>0,'title'=> 'Chi tiết phiếu bảo trì', 'class'=>"text-primary", 'role'=>'modal-remote']);
        },
        'width' => '200px',
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_ke_hoach',
        'label'=>'Thuộc KHBT',
        'format'=>'raw',
        'value'=>function($model){
            $khBaoTriLabel = 'Kế hoạch #' . $model->id;
            return Html::a($khBaoTriLabel, ['/baotri/ke-hoach-bao-tri/view','id'=>$model->id_ke_hoach],
                ['data-pjax'=>0,'title'=> 'Chi tiết Kế hoạch bảo trì', 'class'=>"text-primary", 'role'=>'modal-remote']);
       },
       'width' => '200px',
   ], 
        
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'keHoach.thietBi.ten_thiet_bi',
        'format'=>'raw',
        'value'=>function($model){
            return ($model->keHoach != NULL && $model->keHoach->thietBi != NULL) ? Html::a($model->keHoach->thietBi->ten_thiet_bi, ['/taisan/thiet-bi/view','id'=>$model->keHoach->id_thiet_bi],
                ['data-pjax'=>0,'title'=> 'Chi tiết thiết bị', 'class'=>"text-primary", 'role'=>'modal-remote']) : '';
        },
        'width' => '350px',
    ],        
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ky_thu',
        'value'=>function($model){
            return 'Kỳ thứ ' . $model->ky_thu;
        },
        'width' => '80px',
    ],
        
   /*  [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_ke_hoach',
        'format'=>'raw',
        'value'=>function($model){
            $keHoach=$model->keHoach;
            $html=Html::a($keHoach ? ('Kế hoạch #' .$keHoach->id) : "", ['/baotri/ke-hoach-bao-tri/view','id'=>$model->id_ke_hoach],
                ['data-pjax'=>0,'title'=> 'Chi tiết kế hoạch', 'class'=>"text-primary", 'role'=>'modal-remote']);
            return $html;
        }
    ], */
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_don_vi_bao_tri',
        'format'=>'raw',
        'value'=>function($model){
            $dvbt=$model->donViBaoTri;
            $html=Html::a($dvbt ? $dvbt->ten_bo_phan : "", ['/bophan/bo-phan/view','id'=>$model->id_don_vi_bao_tri],
                ['data-pjax'=>0,'title'=> 'Chi tiết đơn vị chịu trách nhiệm', 'class'=>"text-primary", 'role'=>'modal-remote']);
            return $html;
        },
        'width' => '100px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_nguoi_chiu_trach_nhiem',
        'format'=>'raw',
        'value'=>function($model){
        $dvbt=$model->nguoiChiuTrachNhiem;
        $html=Html::a($dvbt ? $dvbt->ten_nhan_vien : "", ['/bophan/nhan-vien/view','id'=>$model->id_nguoi_chiu_trach_nhiem],
            ['data-pjax'=>0,'title'=> 'Chi tiết người chịu trách nhiệm', 'class'=>"text-primary", 'role'=>'modal-remote']);
        return $html;
        },
        'width' => '70px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'thoi_gian_bat_dau',
        'value'=>function($model){
        $cus = new CustomFunc();
        if ($model->thoi_gian_bat_dau != null) {
            return $cus->convertYMDToDMY($model->thoi_gian_bat_dau);
        }
        else return null;
        },
        'width' => '70px',
    ],
    /* [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'thoi_gian_ket_thuc',
        'value'=>function($model){
        $cus = new CustomFunc();
        if ($model->thoi_gian_ket_thuc != null) {
            return $cus->convertYMDToDMY($model->thoi_gian_ket_thuc);
        }
        else return null;
        }
    ], */
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'da_hoan_thanh',
        'format'=>'html',
        'value'=>function($model){
            return  $model->da_hoan_thanh ==1 ? StatusWithIconWidget::widget([
                'label' => 'Đã thực hiện',
                'icon'=>'fe fe-check-square',
                //'type'=>'warning'
            ]) : StatusWithIconWidget::widget([
                'label' => 'Chưa thực hiện',
                'icon'=>'fe fe-minus-square',
                'type'=>'warning'
            ]);
        },
        'width' => '70px',
    ],
    
   
    

];   