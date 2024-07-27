<li class="slide">
	<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
		<span class="side-menu__icon"><i class="bi bi-pin-map side_menu_img"></i></span>
		<span class="side-menu__label">Sửa chữa</span><i class="angle fe fe-chevron-right"></i>
	</a>
	<ul class="slide-menu" data-menu="psc">
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
							<li class=""><a href="<?= Yii::getAlias('@web/suachua/phieu-sua-chua?menu=psc1') ?>" class="slide-item" data-menu="psc1">Phiếu sửa chữa</a>
							</li>
                            <li class=""><a href="<?= Yii::getAlias('@web/suachua/bao-gia-sua-chua?menu=psc2') ?>" class="slide-item" data-menu="psc2">Báo giá sửa chữa</a>
							</li>
							<!-- <li class=""><a href="<?= Yii::getAlias('@web/suachua/dm-tt-sua-chua?menu=psc3') ?>" class="slide-item" data-menu="psc3">Trung tâm sửa chữa</a>
							</li> -->
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