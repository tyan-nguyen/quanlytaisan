<?php
use app\modules\user\models\User;
?>
<li class="slide menu-ul-header">
	<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
		<span class="side-menu__icon"><i class="fe fe-users side_menu_img"></i></span>
		<span class="side-menu__label">Phòng ban - Bộ phận</span><i class="angle fe fe-chevron-right"></i>
	</a>
	<ul class="slide-menu" data-menu="pbbp">
		<li class="panel sidetab-menu">
			<div class="tab-menu-heading p-0 pb-2 border-0">
				<div class="tabs-menu ">
					<ul class="nav panel-tabs">
						<li><a href="#side5" class="active" data-bs-toggle="tab"><i
									class="bi bi-house"></i>
								<p>Home</p>
							</a></li>
						<li><a href="#side6" data-bs-toggle="tab"><i class="bi bi-box"></i>
								<p>Activity</p>
							</a></li>
					</ul>
				</div>
			</div>
			<div class="panel-body tabs-menu-body p-0 border-0">
				<div class="tab-content">
					<div class="tab-pane active" id="side5">
						<ul class="sidemenu-list">
							<li class="side-menu__label1"><a href="javascript:void(0)">Danh mục chức năng</a>
							</li>
							<?php if(User::canRoute('bophan/bo-phan/index')) :?>
							<li><a href="<?= Yii::getAlias('@web/bophan/bo-phan?menu=pbbp1') ?>" class="slide-item" data-menu="pbbp1">Phòng ban - Bộ phận</a>
							</li>
							<?php endif;?>
							<?php if(User::canRoute('bophan/nhan-vien/index')) :?>
							<li class=""><a href="<?= Yii::getAlias('@web/bophan/nhan-vien?menu=pbbp2') ?>" class="slide-item" data-menu="pbbp2">Danh sách nhân viên</a></li>
							<?php endif;?>
							<?php if(User::canRoute('bophan/doi-tac/index')) :?>
							<li class=""><a href="<?= Yii::getAlias('@web/bophan/doi-tac?menu=pbbp3') ?>" class="slide-item" data-menu="pbbp3">Danh sách Đối tác</a>
							</li>
							<?php endif;?>
							<?php if(User::canRoute('bophan/dm-dv-bao-gia/index')) :?>
							<li class=""><a href="<?= Yii::getAlias('@web/bophan/dm-dv-bao-gia?menu=pbbp5') ?>" class="slide-item" data-menu="pbbp5">Đơn vị báo giá</a>
							</li>
							<?php endif;?>
							<?php if(User::canRoute('bophan/nhom-doi-tac/index')) :?>
							<li class=""><a href="<?= Yii::getAlias('@web/bophan/nhom-doi-tac?menu=pbbp4') ?>" class="slide-item" data-menu="pbbp4">Nhóm Đối tác</a>
							</li>
							<?php endif;?>
							<?php if(User::canRoute('kholuutru/kho/index')) :?>
							<li class=""><a href="<?= Yii::getAlias('@web/kholuutru/kho?menu=pbbp6') ?>" class="slide-item" data-menu="pbbp6">Danh mục kho</a>
							</li>
							<?php endif;?>
						</ul>
						<div class="menutabs-content px-0">
							<!-- menu tab here -->
						</div>
					</div>
					<div class="tab-pane" id="side6">
						<!-- activity here -->
					</div>
				</div>
			</div>
		</li>

	</ul>
</li>