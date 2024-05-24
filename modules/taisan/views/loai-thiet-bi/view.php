<?php

use yii\widgets\DetailView;
use app\modules\dungchung\models\History;
use app\modules\taisan\models\LoaiThietBi;

/* @var $this yii\web\View */
/* @var $model app\modules\taisan\models\LoaiThietBi */
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
                    //'id',
                    'ma_loai',
                    'ten_loai',
                    'don_vi_tinh',
                    [
                        'attribute'=>'truc_thuoc',
                        'value'=>$model->tenTrucThuoc
                    ],
                    [
                        'attribute'=>'loai_thiet_bi',
                        'value'=>$model->tenLoaiThietBi
                    ],
                    'ghi_chu:ntext',
                ],
            ]) ?>
            </div>
            <div class="tab-pane" id="tab2" role="tabpanel">
				<?= History::showHistory(LoaiThietBi::MODEL_ID, $model->id) ?>
			</div>

		</div>
	</div>
</div><!-- panel -->
