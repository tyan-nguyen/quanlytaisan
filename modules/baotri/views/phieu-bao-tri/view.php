<?php

use yii\widgets\DetailView;
use app\widgets\views\DocumentListWidget;
use app\modules\dungchung\models\History;
use app\modules\baotri\models\PhieuBaoTri;
use app\widgets\views\StatusWithIconWidget;
use app\modules\dungchung\models\CustomFunc;

$custom = new CustomFunc();
/* @var $this yii\web\View */
/* @var $model app\modules\baotri\models\PhieuBaoTri */
?>
<div class="phieu-bao-tri-view">

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
			<div class="col-md-12">				
				<div class="card custom-card div-600">
					<div class="card-body">
						<div>
							<h6 class="card-title">Thông tin chung</h6>
							<p class="text-muted card-sub-title">Thông tin chung của Kế hoạch bảo trì - Tài sản/Thiết bị: <?= $model->keHoach->thietBi->ten_thiet_bi ?> (<?= $model->keHoach->thietBi->ma_thiet_bi ?>).</p>
						</div>
						<div class="text-wrap">
							
							 <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id'=>[
                                        'attribute'=>'id',
                                        'value'=>'Phiếu bảo trì #' . $model->id_ke_hoach
                                    ],
                                    'id_ke_hoach'=>[
                                        'attribute'=>'id_ke_hoach',
                                        'value'=>'Kế hoạch bảo trì #' . $model->id_ke_hoach
                                    ],
                                    'ky_thu',
                                    'id_don_vi_bao_tri'=>[
                                        'attribute'=>'id_don_vi_bao_tri',
                                        'value'=>$model->donViBaoTri ? $model->donViBaoTri->ten_bo_phan : ''
                                    ],
                                    'id_nguoi_chiu_trach_nhiem'=>[
                                        'attribute'=>'id_nguoi_chiu_trach_nhiem',
                                        'value'=>$model->nguoiChiuTrachNhiem ? $model->nguoiChiuTrachNhiem->ten_nhan_vien : ''
                                    ],
                                    'thoi_gian_bat_dau'=>[
                                        'attribute'=>'thoi_gian_bat_dau',
                                        'value'=>$custom->convertYMDHISToDMY($model->thoi_gian_bat_dau)
                                    ],
                                    'thoi_gian_ket_thuc'=>[
                                        'attribute'=>'thoi_gian_ket_thuc',
                                        'value'=>$custom->convertYMDHISToDMY($model->thoi_gian_ket_thuc)
                                    ],
                                    'noi_dung_thuc_hien:ntext',
                                    'da_hoan_thanh'=>[
                                        'attribute'=>'da_hoan_thanh',
                                        'format'=>'html',
                                        'value'=>$model->da_hoan_thanh ==1 ? StatusWithIconWidget::widget([
                                            'label' => 'Đã thực hiện',
                                            'icon'=>'fe fe-check-square',
                                            //'type'=>'warning'
                                        ]) : StatusWithIconWidget::widget([
                                            'label' => 'Chưa thực hiện',
                                            'icon'=>'fe fe-minus-square',
                                            'type'=>'warning'
                                        ]),
                                    ],
                        //            'thoi_gian_tao',
                        //            'nguoi_tao',
                                ],
                            ]) ?>

						</div>
					</div>
				</div>								
            </div>
            
            <div class="col-md-12">
            
             <!-- print phieu -->
           <div style="display:none">
                <div id="print">
                	<?php $this->render('_print_phieu', compact('model')) ?>
                </div>
           </div>
                 
            <!--  <a href="#" onClick="InPhieu()" class="btn ripple btn-main-primary"><i class="fa fa-print"></i> In Phiếu</a>  -->
            </div>
           
            
             </div><!-- row -->
		</div>
		
		<div class="tab-pane" id="tab3" role="tabpanel">
			<div class="row">
			<?=  DocumentListWidget::widget([
			    'loai' => PhieuBaoTri::MODEL_ID,
        	    'id_tham_chieu' => $model->id
        	])  ?>
        	</div>
        	<?php // $this->render('_taiLieu', ['model'=>$model]) ?>
		</div>
		
		<div class="tab-pane" id="tab2" role="tabpanel">
			<?= History::showHistory(PhieuBaoTri::MODEL_ID, $model->id) ?>
		</div>
	</div>
</div>
	</div>
</div>

<script>
function InPhieu(){
	//load lai phieu in (tranh bi loi khi chinh sua du lieu chua update noi dung in)
	$.ajax({
        type: 'post',
        url: '/baotri/phieu-bao-tri/get-phieu-bao-tri-in-ajax?idPhieu=' + <?= $model->id ?>,
        //data: frm.serialize(),
        success: function (data) {
            console.log('Submission was successful.');
            console.log(data);            
            if(data.status == 'success'){
            	$('#print').html(data.content);
            	printPhieu();//call from script.js
            } else {
            	alert('Vật tư không còn tồn tại trên hệ thống!');
            }
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });	
}
</script>
