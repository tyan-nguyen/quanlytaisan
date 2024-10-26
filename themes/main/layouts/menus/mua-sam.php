<?php 
$phieuMuaSamNewCount = count($phieuMuaSamNew);
$phieuTotal = $baoGiaMuaSamNewCount + $phieuMuaSamNewCount;
?>
<li class="slide">
	<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
		<span class="side-menu__icon"><i class="bi bi-pin-map side_menu_img"></i></span>
		<span class="side-menu__label">Mua sắm <?= $phieuTotal>0?'<span class="badge bg-warning ms-2">'.$phieuTotal.'</span>':'' ?></span><i class="angle fe fe-chevron-right"></i>
	</a>
	<ul class="slide-menu" data-menu="pms">
		<li class="panel sidetab-menu">
			<div class="tab-menu-heading p-0 pb-2 border-0">
				<div class="tabs-menu ">
					<ul class="nav panel-tabs">
						<li><a href="#side7" class="active" data-bs-toggle="tab"><i
									class="bi bi-house"></i>
								<p>Home</p>
							</a></li>
						<li><a href="#side8" data-bs-toggle="tab"><i class="bi bi-box"></i>
								<p>Activity</p>
							</a></li>
					</ul>
				</div>
			</div>
			<div class="panel-body tabs-menu-body p-0 border-0">
				<div class="tab-content">
					<div class="tab-pane active" id="side7">
						<ul class="sidemenu-list">
							<li class="side-menu__label1"><a href="javascript:void(0)">Danh mục chức năng</a>
							</li>
							<li class=""><a href="<?= Yii::getAlias('@web/muasam/phieu-mua-sam?menu=pms1') ?>" class="slide-item" data-menu="pms1">Mua sắm thiết bị</a>
							</li>
							<li class=""><a href="<?= Yii::getAlias('@web/muasam/phieu-mua-sam/list-mua-sam-vat-tu?menu=pms4') ?>" class="slide-item" data-menu="pms4">Mua sắm vật tư</a>
							</li>
							<li class=""><a href="<?= Yii::getAlias('@web/muasam/phieu-mua-sam/duyet-phieu-mua-sam?menu=pms3') ?>" class="slide-item" data-menu="pms3">Duyệt phiếu mua sắm <?= $phieuMuaSamNewCount>0?'<span class="badge bg-warning ms-2">'.$phieuMuaSamNewCount.'</span>':'' ?></a>
							</li>
                            <li class=""><a href="<?= Yii::getAlias('@web/muasam/bao-gia-mua-sam?menu=pms2') ?>" class="slide-item" data-menu="pms2">Báo giá mua sắm <?= $baoGiaMuaSamNewCount>0?'<span class="badge bg-warning ms-2">'.$baoGiaMuaSamNewCount.'</span>':'' ?></a>
							</li>
							
						</ul>
						<div class="menutabs-content px-0">
							<!-- menu tab here -->
						</div>
					</div>
					<div class="tab-pane" id="side8">
						<!-- activity here -->
					</div>
				</div>
			</div>
		</li>

	</ul>
</li>