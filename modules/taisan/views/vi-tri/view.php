<?php

use yii\widgets\DetailView;
use app\widgets\forms\SwitchWidget;
use app\modules\dungchung\models\History;
use app\modules\taisan\models\ViTri;

/* @var $this yii\web\View */
/* @var $model app\modules\taisan\models\ViTri */
?>
<div class="panel panel-primary">
	<div class="tab-menu-heading tab-menu-heading-boxed">
		<div class="tabs-menu-boxed">
			<!-- Tabs -->
			<ul class="nav panel-tabs" role="tablist">
				<li><a href="#tab1" class="active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
					Thông tin chung
				</a></li>
				<li><a href="#tab2" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">
					Lịch sử thay đổi
				</a></li>
			</ul>
		</div>
	</div>
	
	<div class="panel-body tabs-menu-body ps">
		<div class="tab-content">
 			<div class="tab-pane  active show" id="tab1" role="tabpanel">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'ma_vi_tri',
                        'ten_vi_tri',
                        'mo_ta:ntext',
                        [
                            'attribute'=>'truc_thuoc',
                            'value'=>$model->tenViTriTrucThuoc
                        ],
                        [
                            'attribute'=>'da_ngung_hoat_dong',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'da_ngung_hoat_dong',
                                'type'=>'VIEW'
                            ])
                        ],
                        [
                            'attribute' => 'ngay_ngung_hoat_dong',
                            'value' => $model->getNgayNgungHoatDong()
                        ],
                        //'id_layout',
                        'toa_do_x',
                        'toa_do_y',
                    ],
                ]) ?>
				</div>
            <div class="tab-pane" id="tab2" role="tabpanel">
				<?= History::showHistory(ViTri::MODEL_ID, $model->id) ?>
			</div>

		</div>
	</div>
</div><!-- panel -->
