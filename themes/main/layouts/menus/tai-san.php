<?php
use app\modules\user\models\User;
?>
<li class="slide menu-ul-header">
	<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
		<span class="side-menu__icon"><i class="bi bi-ui-checks-grid side_menu_img"></i></span>
		<span class="side-menu__label">Tài sản</span><i class="angle fe fe-chevron-right"></i>
	</a>
	<ul class="slide-menu" data-menu="ts">
		<li class="panel sidetab-menu">
			<div class="tab-menu-heading p-0 pb-2 border-0">
				<div class="tabs-menu ">
					<ul class="nav panel-tabs">
						<li><a href="#side3" class="active" data-bs-toggle="tab"><i class="bi bi-house"></i>
								<p>Home</p>
							</a></li>
						<li><a href="#side4" data-bs-toggle="tab"><i class="bi bi-box"></i>
								<p>Activity</p>
							</a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body tabs-menu-body p-0 border-0">
				<div class="tab-content">
					<div class="tab-pane active" id="side3">
						<ul class="sidemenu-list">
							<li class="side-menu__label1"><a href="javascript:void(0)">Danh mục chức năng</a></li>
							<?php if(User::hasPermission('qQuanLyTaiSan')) :?>
							<li><a href="/taisan/thiet-bi?menu=ts1" class="slide-item" data-menu="ts1">Quản lý tài sản</a></li>
							<?php endif;?>
							<?php if(User::hasPermission('qQuanLyVatTu')) :?>
							<li><a href="/kholuutru/dm-vat-tu?menu=ts7" class="slide-item" data-menu="ts7">Quản lý vật tư</a></li>
							<?php endif;?>
							<?php if(User::canRoute('taisan/thiet-bi/index-user')) :?>
							<li><a href="/taisan/thiet-bi/index-user?menu=ts5" class="slide-item" data-menu="ts5">Cá nhân quản lý</a></li>
							<?php endif;?>
							<?php if(User::canRoute('taisan/thiet-bi/index-bo-phan')) :?>
							<li><a href="/taisan/thiet-bi/index-bo-phan?menu=ts6" class="slide-item" data-menu="ts6">Bộ phận quản lý</a></li>
							<?php endif;?>
							<?php if(User::canRoute('taisan/loai-thiet-bi/index')) :?>
							<li><a href="/taisan/loai-thiet-bi?menu=ts2" class="slide-item" data-menu="ts2">Loại thiết bị, máy móc</a></li>
							<?php endif;?>
							<?php if(User::canRoute('taisan/he-thong/index')) :?>
							<li><a href="/taisan/he-thong?menu=ts3" class="slide-item" data-menu="ts3">Hệ thống</a></li>
							<?php endif;?>
							<?php if(User::canRoute('taisan/vi-tri/index')) :?>
							<li><a href="/taisan/vi-tri?menu=ts4" class="slide-item" data-menu="ts4">Vị trí </a></li>
							<?php endif;?>
							<?php if(User::canRoute('taisan/thong-ke/thong-ke-tai-san-mua-sam') || User::canRoute('taisan/thong-ke/thong-ke-tai-san-hoat-dong')) :?>
							<li class="sub-slide is-expanded">
    							<a class="slide-item side-menu__item-sub" data-bs-toggle="sub-slide" href="javascript:void(0)">
    								<span class="sub-side-menu__label">Thống kê</span>
    								<i class="sub-angle fe fe-chevron-right"></i>
    							</a>
    							<ul class="sub-slide-menu open" style="display: block;">
    								<?php if(User::canRoute('taisan/thong-ke/thong-ke-tai-san-mua-sam')) :?>
    								<li><a class="sub-side-menu__item" href="/taisan/thong-ke/thong-ke-tai-san-mua-sam?menu=ts8" data-menu="ts8">Thống kê mua sắm</a></li>
    								<?php endif;?>
    								<?php if(User::canRoute('taisan/thong-ke/thong-ke-tai-san-hoat-dong')) :?>
    								<li><a class="sub-side-menu__item" href="/taisan/thong-ke/thong-ke-tai-san-hoat-dong?menu=ts9" data-menu="ts9">Thống kê hoạt động thiết bị, máy móc</a></li>
    								<?php endif;?>
    							</ul>
    						</li>
    						<?php endif;?>

						</ul>
						<div class="menutabs-content px-0">
							<!-- menu tab here -->
						</div>
					</div>
					<div class="tab-pane" id="side4">
						<!-- activity here -->
					</div>
				</div>
			</div>
		</li>

	</ul>
</li>