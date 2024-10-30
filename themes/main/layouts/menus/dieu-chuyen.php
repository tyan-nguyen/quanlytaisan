<?php
use app\modules\user\models\User;
?>
<li class="slide menu-ul-header">
	<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
		<span class="side-menu__icon"><i class="bi bi-arrow-left-right side_menu_img"></i></span>
		<span class="side-menu__label">Điều chuyển thiết bị 
		<?php if(User::hasPermission('qDuyetDieuChuyenThietBi',false)):?>
		<span class="notification-count-left"></span> 
		<?php endif;?>
		</span><i class="angle fe fe-chevron-right"></i>
	</a>
	<ul class="slide-menu" data-menu="dc">
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
							<?php if(User::canRoute('taisan/yeu-cau-van-hanh/index')) :?>
							<li><a href="/taisan/yeu-cau-van-hanh?menu=dc1" class="slide-item" data-menu="dc1">Danh sách điều chuyển</a></li>
							<?php endif;?>
							<?php if(User::hasPermission('qDuyetDieuChuyenThietBi',false)) :?>
							<li><a href="/taisan/phe-duyet-yeu-cau-van-hanh?menu=dc2" class="slide-item" data-menu="dc2">Phê duyệt điều chuyển <span class="notification-count-left"></span></a></li>
							<?php endif;?>
							<!-- 
							<li><a href="/taisan/xuat-yeu-cau-van-hanh?menu=dc3" class="slide-item" data-menu="dc3">Xuất và vận hành</a></li> -->
							<?php if(User::canRoute('taisan/theo-doi-van-hanh/index')) :?>
							<li><a href="/taisan/theo-doi-van-hanh?menu=dc5" class="slide-item" data-menu="dc5">Theo dõi thiết bị</a></li>
							<?php endif;?>
							<?php if(User::canRoute('taisan/phieu-tra-thiet-bi/index')) :?>
							<li><a href="/taisan/phieu-tra-thiet-bi?menu=dc4" class="slide-item" data-menu="dc4">Phiếu trả thiết bị</a></li>
							<?php endif;?>
							<!-- <li><a href="/taisan/theo-doi-van-hanh/list-calendar/?menu=dc6" class="sub-side-menu__item" data-menu="dc6">Danh sách</a></li> -->
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