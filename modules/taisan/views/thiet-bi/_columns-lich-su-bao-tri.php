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
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ky_thu',
        'value'=>function($model){
            return 'Kỳ bảo trì thứ ' . $model->ky_thu;
        }
    ],
        
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_ke_hoach',
        'format'=>'raw',
        'value'=>function($model){
            $keHoach=$model->keHoach;
            $html=Html::a($keHoach ? ('Kế hoạch #' .$keHoach->id) : "", ['/baotri/ke-hoach-bao-tri/view','id'=>$model->id_ke_hoach],
                ['data-pjax'=>0,'title'=> 'Chi tiết kế hoạch', 'class'=>"text-primary", 'role'=>'modal-remote']);
            return $html;
        }
    ],
    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_don_vi_bao_tri',
        'format'=>'raw',
        'value'=>function($model){
            $dvbt=$model->donViBaoTri;
            $html=Html::a($dvbt ? $dvbt->ten_bo_phan : "", ['/bophan/bo-phan/view','id'=>$model->id_don_vi_bao_tri],
                ['data-pjax'=>0,'title'=> 'Chi tiết đơn vị chịu trách nhiệm', 'class'=>"text-primary", 'role'=>'modal-remote']);
            return $html;
        }
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
        }
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
        }
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
        }
    ],
    
   
    

];   