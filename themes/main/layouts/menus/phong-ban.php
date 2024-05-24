<li class="slide">
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
							<li><a href="<?= Yii::getAlias('@web/bophan/bo-phan?menu=pbbp1') ?>" class="slide-item" data-menu="pbbp1">Phòng ban - Bộ phận</a>
							</li>
							<li class=""><a href="<?= Yii::getAlias('@web/bophan/nhan-vien?menu=pbbp2') ?>" class="slide-item" data-menu="pbbp2">Danh sách nhân viên</a>
							<li class=""><a href="<?= Yii::getAlias('@web/bophan/doi-tac?menu=pbbp3') ?>" class="slide-item" data-menu="pbbp3">Danh sách Đối tác</a>
							</li>
							</li>
							<li class=""><a href="<?= Yii::getAlias('@web/bophan/nhom-doi-tac?menu=pbbp4') ?>" class="slide-item" data-menu="pbbp4">Nhóm Đối tác</a>
							</li>
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