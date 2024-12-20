<?php

use yii\widgets\DetailView;
use app\widgets\forms\SwitchWidget;
use app\modules\dungchung\models\History;
use app\modules\bophan\models\DoiTac;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\DoiTac */
?>
<div class="panel panel-primary">
	<div class="tab-menu-heading tab-menu-heading-boxed">
		<div class="tabs-menu-boxed">
			<!-- Tabs -->
			<ul class="nav panel-tabs" role="tablist">
				<li><a href="#tab1" class="active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
					Thông tin chung
				</a></li>
				<li><a href="#tab3" data-bs-toggle="tab" aria-selected="true" role="tab">
					Lịch sử thay đổi
				</a></li>
                <li><a href="#tab4" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">Đánh giá sửa chữa</a></li>
                <li><a href="#tab5" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">Đánh giá mua sắm</a></li>
			</ul>
		</div>
	</div>
	<div class="panel-body tabs-menu-body ps">
		<div class="tab-content">
 			<div class="tab-pane  active show" id="tab1" role="tabpanel">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        //'id',
                        'ma_doi_tac',
                        'ten_doi_tac',
                        [
                            'attribute'=>'id_nhom_doi_tac',
                            'value'=>$model->tenNhomDoiTac,
                        ],
                        'dia_chi:ntext',
                        'dien_thoai',
                        'email:email',
                        'tai_khoan_ngan_hang',
                        'ma_so_thue',
                        [
                            'attribute'=>'la_nha_cung_cap',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_nha_cung_cap',
                                'type'=>'VIEW'
                            ])
                        ],
                        [
                            'attribute'=>'la_khach_hang',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_khach_hang',
                                'type'=>'VIEW'
                            ])
                        ],
                        [
                            'label'=>'Đánh giá mua sắm',
                            'format'=>'raw',
                            'value'=>'<div class="star-ratings-css" title="'.floor($model->getDanhGiaMuaSamTrungBinh()).'">'. ($model->getDanhGiaMuaSamTrungBinh()>0?$model->getDanhGiaMuaSamTrungBinh():'') .'</div>'
                        ],
                        [
                            'label'=>'Đánh giá sửa chữa',
                            'format'=>'raw',
                            'value'=>'<div class="star-ratings-css" title="'.floor($model->getDanhGiaSuaChuaTrungBinh()).'">'. ($model->getDanhGiaSuaChuaTrungBinh()>0?$model->getDanhGiaSuaChuaTrungBinh():'') .'</div>'
                        ]
                        //'thoi_gian_tao',
                        //'nguoi_tao',
                    ],
                ]) ?>
            </div>
            <div class="tab-pane" id="tab3" role="tabpanel">
				<?= History::showHistory(DoiTac::MODEL_ID, $model->id) ?>
			</div>
            <div class="tab-pane" id="tab4" role="tabpanel">
                <?= $this->render('./danh-gia-suachua', [
                    'model' => $model
                ]) ?>
			</div>
            <div class="tab-pane" id="tab5" role="tabpanel">
                <?= $this->render('./danh-gia-muasam', [
                    'model' => $model
                ]) ?>
			</div>

        </div>
	</div>
</div>
