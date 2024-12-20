<?php
use app\modules\user\models\User;
?>
<li class="slide menu-ul-header">
	<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
		<span class="side-menu__icon"><i class="ion-settings side_menu_img"></i></span>
		<span class="side-menu__label">Bảo trì - Bảo dưỡng</span><i class="angle fe fe-chevron-right"></i>
	</a>
	<ul class="slide-menu" data-menu="btbd">
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
							
							<?php if(User::canRoute('baotri/lich-bao-tri/baotri')) :?>
							<li><a href="/baotri/lich-bao-tri/baotri?menu=btbd0" class="slide-item" data-menu="btbd0">Danh sách đến hạn bảo trì</a></li>
							<?php endif;?>
							
							<?php if(User::canRoute('baotri/lich-bao-tri/index')) :?>
							<li><a href="/baotri/lich-bao-tri?menu=btbd1" class="slide-item" data-menu="btbd1">Lịch bảo trì</a></li>
							<?php endif;?>
							
							<?php if(User::canRoute('baotri/ke-hoach-bao-tri/index')) :?>
							<li><a href="/baotri/ke-hoach-bao-tri?menu=btbd2" class="slide-item" data-menu="btbd2">Kế hoạch bảo trì</a></li>
							<?php endif;?>
							
							<?php if(User::canRoute('baotri/loai-bao-tri/index')) :?>
							<li><a href="/baotri/loai-bao-tri?menu=btbd3" class="slide-item" data-menu="btbd3">Danh mục loại bảo trì</a>
							</li>
							<?php endif;?>
							
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