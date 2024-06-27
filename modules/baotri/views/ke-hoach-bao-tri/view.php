<?php

use yii\widgets\DetailView;
use app\modules\baotri\models\KeHoachBaoTri;
use app\modules\dungchung\models\History;
use app\widgets\views\DocumentListWidget;
use Da\QrCode\Label;
use app\modules\dungchung\models\CustomFunc;

$cus = new CustomFunc();

/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\KeHoachBaoTri */
?>
<div class="ke-hoach-bao-tri-view">
 
</div>

<div class="panel panel-primary">
	<div class="tab-menu-heading tab-menu-heading-boxed">
		<div class="tabs-menu-boxed">
			<!-- Tabs -->
			<ul class="nav panel-tabs" role="tablist">
				<li><a href="#tab1" class="active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
					Thông tin chung
				</a></li>
				<li><a href="#tab4" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
					Phiếu bảo trì
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
				<div class="col-md-6">				
    				<div class="card custom-card div-600">
    					<div class="card-body">
    						<div>
    							<h6 class="card-title">Thông tin chung</h6>
    							<p class="text-muted card-sub-title">Thông tin chung của Kế hoạch bảo trì.</p>
    						</div>
    						<div class="text-wrap">
    							
    							<?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'id',
                                        [
                                            'label'=>'Hệ thống',
                                            'attribute'=>'heThong.ten_he_thong',
                                        ],
                                        'thietBi.ten_thiet_bi',
                                        'id_chi_tiet',
                                        [
                                            'label'=>'Loại bảo trì',
                                            'value'=>$model->loaiBaoTri->ten,
                                        ],
                                        //'loaiBaoTri.ten',
                                        'can_cu',
                                       
                                        [
                                            'label'=>'Mức độ ưu tiên',
                                            //["0"=> "Không ưu tiên", "1"=>"Ưu tiên", "2"=>"Xử lý gấp"],
                                            'value'=>function($data){
                                                if($data->muc_do_uu_tien=="0") return "Không ưu tiên";
                                                elseif ($data->muc_do_uu_tien=="1") return "Ưu tiên";
                                                else return "Xử lý gấp";
                                            }
                                        ],
                                        'truc_thuoc',
                                        [
                                            'attribute'=>'ky_bao_tri',
                                            'value'=>$model->getKyBaoTriLabel($model->ky_bao_tri),
                                        ],
                                        'tan_suat',
                                        
                                       
                                        'da_het_hieu_luc',
                                        
                                        'ngay_het_hieu_luc',
            //                             'thoi_gian_tao',
            //                             'nguoi_tao',
                                    ],
                                ]) ?>
    
    						</div>
    					</div>
    				</div>								
                </div>
                
                <div class="col-md-6">
                	<div class="card custom-card div-600">
    					<div class="card-body">
    						<div>
    							<h6 class="card-title">Thông tin tạo phiếu bảo trì</h6>
    							<p class="text-muted card-sub-title">Thông tin để tạo các phiếu bảo trì.</p>
    						</div>
    						<div class="text-wrap">
    							
    								<?= DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [                                          
                                            'ten_cong_viec',
                                            [
                                                'label'=>'Loại bảo trì',
                                                'value'=>$model->loaiBaoTri->ten,
                                            ],
                                            [
                                                'attribute'=>'ngay_bat_dau',
                                                'value'=>$cus->convertYMDToDMY($model->ngay_bat_dau),
                                            ],
                                            //'loaiBaoTri.ten',
                                            [
                                                'attribute'=>'bao_truoc',
                                                'value'=>$model->bao_truoc . ' (ngày)',
                                            ],
                                            [
                                                'attribute'=>'so_ky',
                                                'value'=>$model->so_ky . ' (kỳ)',
                                            ],
                                            [
                                                'attribute'=>'id_don_vi_bao_tri',
                                                'value'=>$model->donViBaoTri->ten_bo_phan,
                                            ],
                                            [
                                                'label'=>'Chịu trách nhiệm',
                                                'value'=> $model->nguoiChiuTrachNhiem->ten_nhan_vien,
                                            ],
                                            
                                           
                                            'thoi_gian_thuc_hien'=>[
                                                'attribute'=>'thoi_gian_thuc_hien',
                                                'value'=>$model->thoi_gian_thuc_hien . ' (' . $model->don_vi_thoi_gian . ')'
                                            ],
                                            //'don_vi_thoi_gian',
                                            [
                                                'label'=>'Dừng máy',
                                                'value'=> $model->dung_may=="0"? "Không": "Dừng",
                                            ],
                                            [
                                                'label'=>'Thuê ngoài',
                                                'value'=> $model->thue_ngoai=="0"? "Không": "Có",
                                            ],
                                            
                                        ],
                                    ]) ?>
    
    						</div>
    						
    						<!-- 
    						<div class="mg-s-20">
    						<a class="btn btn-primary" href="/baotri/ke-hoach-bao-tri/tao-phieu-bao-tri?id=<?= $model->id ?>" role="modal-remote"><span class="ti-pencil-alt"></span> Tạo phiếu bảo trì</a>
    						</div>-->
    						
    					</div>
    				</div>
                </div>
                
                 </div><!-- row -->
			</div>
			
			<div class="tab-pane" id="tab3" role="tabpanel">
				<div class="row">
				<?=  DocumentListWidget::widget([
				    'loai' => KeHoachBaoTri::MODEL_ID,
            	    'id_tham_chieu' => $model->id
            	])  ?>
            	</div>
            	<?php // $this->render('_taiLieu', ['model'=>$model]) ?>
			</div>
			
			<div class="tab-pane" id="tab2" role="tabpanel">
				<?= History::showHistory(KeHoachBaoTri::MODEL_ID, $model->id) ?>
			</div>
			
			<div class="tab-pane" id="tab4" role="tabpanel">
            	<?= $this->render('phieu-bao-tri', [
                            'searchModel' => $searchModelBaoTri,
                            'dataProvider' => $dataProviderBaoTri,
                        ]) ?>
			</div>
		</div>
	</div>

</div>
