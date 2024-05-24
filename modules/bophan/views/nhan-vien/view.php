<?php

use yii\widgets\DetailView;
use app\widgets\forms\SwitchWidget;
use app\widgets\forms\RadioWidget;
use app\modules\dungchung\models\History;
use app\modules\bophan\models\NhanVien;
use app\widgets\views\ImageListWidget;
use app\widgets\views\DocumentListWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\bophan\models\NhanVien */
?>
<div class="panel panel-primary">
	<div class="tab-menu-heading tab-menu-heading-boxed">
		<div class="tabs-menu-boxed">
			<!-- Tabs -->
			<ul class="nav panel-tabs" role="tablist">
				<li><a href="#tab1" class="active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
					Thông tin chung
				</a></li>
				<li><a href="#tab3" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
					Tài liệu
				</a></li>
				<li><a href="#tab2" data-bs-toggle="tab" aria-selected="true" role="tab">
					Lịch sử thay đổi
				</a></li>
				<!-- <li><a href="#tab28" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">Tab 4</a></li> -->
			</ul>
		</div>
	</div>
 	
 	<div class="panel-body tabs-menu-body ps">
		<div class="tab-content">
			<div class="tab-pane  active show" id="tab1" role="tabpanel">
				<div class="row">
				<div class="col-md-8">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id_bo_phan'=>[
                            'attribute'=>'id_bo_phan',
                            'value'=>$model->tenBoPhan
                        ],
                        'ma_nhan_vien',
                        'ten_nhan_vien',
                        'ngay_sinh',
                        'gioi_tinh'=>[
                            'attribute'=>'gioi_tinh',
                            'format'=>'raw',
                            'value'=>RadioWidget::widget([
                                'model'=>$model,
                                'attr'=>'gioi_tinh',
                                'type'=>'VIEW',
                                'list'=>[0=>'Nam', 1=>'Nữ']
                            ])
                        ],
                        'chuc_vu',
                        'ten_truy_cap',
                        'ngay_vao_lam'=>[
                            'attribute' => 'ngay_vao_lam',
                            'value' => $model->getNgayVaoLam()
                        ],
                        'da_thoi_viec'=>[
                            'attribute'=>'da_thoi_viec',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'da_thoi_viec',
                                'type'=>'VIEW'
                            ])
                        ],
                        'ngay_thoi_viec'=>[
                            'attribute' => 'ngay_thoi_viec',
                            'value' => $model->getNgayThoiViec()
                        ],
                        'dien_thoai',
                        'email:email',
                        'dia_chi:ntext',
                    ],
                ]) ?>
                </div>
                <div class="col-md-4">
                	<div class="card custom-card">
                    	<div class="card-body h-100">
                    		<div>
                    			<h6 class="card-title mb-1">Hình ảnh</h6>
                    		</div>
                        	<?= ImageListWidget::widget([
                        	    'loai' => NhanVien::MODEL_ID,
                        	    'id_tham_chieu' => $model->id
                        	]) ?>
                        </div>
                     </div>
                </div><!-- col 6 -->
                </div><!-- row -->
			</div>
			
			<div class="tab-pane" id="tab3" role="tabpanel">
				<div class="row">
				<?=  DocumentListWidget::widget([
            	    'loai' => NhanVien::MODEL_ID,
            	    'id_tham_chieu' => $model->id
            	])  ?>
            	</div>
            	<?php // $this->render('_taiLieu', ['model'=>$model]) ?>
			</div>
			
			<div class="tab-pane" id="tab2" role="tabpanel">
				<?= History::showHistory(NhanVien::MODEL_ID, $model->id) ?>
			</div>
		</div>
	</div>

</div>
