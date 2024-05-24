<?php
use yii\widgets\DetailView;
use app\widgets\forms\SwitchWidget;
use app\modules\dungchung\models\History;
use app\modules\bophan\models\BoPhan;
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
					Thông tin kho
				</a></li>
				<li><a href="#tab3" data-bs-toggle="tab" aria-selected="true" role="tab">
					Lịch sử thay đổi
				</a></li>
				<!-- <li><a href="#tab28" data-bs-toggle="tab" aria-selected="false" role="tab" class="" tabindex="-1">Tab 4</a></li> -->
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
                        'ma_bo_phan',
                        'ten_bo_phan',
                        'truc_thuoc'=>[
                            'attribute'=>'truc_thuoc',
                            'value'=>$model->trucThuoc
                        ],
                        'la_dv_quan_ly'=>[
                            'attribute'=>'la_dv_quan_ly',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_dv_quan_ly',
                                'type'=>'VIEW'
                            ])
                        ],
                        'la_dv_su_dung'=>[
                            'attribute'=>'la_dv_su_dung',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_dv_su_dung',
                                'type'=>'VIEW'
                            ])
                        ],
                        'la_dv_bao_tri'=>[
                            'attribute'=>'la_dv_bao_tri',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_dv_bao_tri',
                                'type'=>'VIEW'
                            ])
                        ],
                        'la_dv_van_tai'=>[
                            'attribute'=>'la_dv_van_tai',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_dv_van_tai',
                                'type'=>'VIEW'
                            ])
                        ],
                        'la_dv_mua_hang'=>[
                            'attribute'=>'la_dv_mua_hang',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_dv_mua_hang',
                                'type'=>'VIEW'
                            ])
                        ],
                        'la_dv_quan_ly_kho'=>[
                            'attribute'=>'la_dv_quan_ly_kho',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_dv_quan_ly_kho',
                                'type'=>'VIEW'
                            ])
                        ],
                        'la_trung_tam_chi_phi'=>[
                            'attribute'=>'la_trung_tam_chi_phi',
                            'format'=>'raw',
                            'value'=>SwitchWidget::widget([
                                'model'=>$model,
                                'attr'=>'la_trung_tam_chi_phi',
                                'type'=>'VIEW'
                            ])
                        ],
                        /* 'id_kho_vat_tu',
                        'id_kho_phe_lieu',
                        'id_kho_thanh_pham',
                        'thoi_gian_tao',
                        'nguoi_tao', */
                    ],
                    'template' => "<tr><th style='width: 40%;'>{label}</th><td>{value}</td></tr>"
                ]) ?>    
			</div>
			
			<div class="tab-pane" id="tab2" role="tabpanel">
				<?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute'=>'id_kho_vat_tu',
                            'value'=>$model->khoVatTu
                        ],
                        [
                            'attribute'=>'id_kho_phe_lieu',
                            'value'=>$model->khoPheLieu
                        ],
                        [
                            'attribute'=>'id_kho_thanh_pham',
                            'value'=>$model->khoThanhPham
                        ],
                    ],
                    'template' => "<tr><th style='width: 30%;'>{label}</th><td>{value}</td></tr>"
                ]) ?>
			</div>
			
			<div class="tab-pane" id="tab3" role="tabpanel">
				<?= History::showHistory(BoPhan::MODEL_ID, $model->id) ?>
			</div>

		</div>
	
    	<!-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
    		<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    	</div>
    	<div class="ps__rail-y" style="top: 0px; right: 0px;">
    		<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    	</div> -->
	
	</div>
</div><!-- panel -->
										
										
<?php 
$this->registerJsFile("@web/assets/plugins/tabs/jquery.multipurpose_tabcontent.js",[
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
$this->registerJsFile("@web/assets/plugins/tabs/tab-content.js",[
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
?>