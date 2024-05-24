<?php
use yii\widgets\ActiveForm;
use app\modules\user\models\User;
?>
<!--Main Header -->
<div class="main-header side-header sticky">
	<div class="container-fluid main-container">
		<div class="main-header-left sidemenu">
			<a class="main-header-menu-icon" href="javascript:void(0);" data-bs-toggle="sidebar"
				id="mainSidebarToggle"><span></span></a>
		</div>
		<div class="main-header-left horizontal">
			<a class="main-logo" href="<?= Yii::getAlias('@web/') ?>">
				<img src="<?= Yii::getAlias('@web') ?>/assets/images/brand/logo.png" class="desktop-logo desktop-logo-dark"
					alt="viboonlogo">
				<img src="<?= Yii::getAlias('@web') ?>/assets/images/brand/logo1.png" class="desktop-logo theme-logo" alt="viboonlogo">
			</a>
		</div>
		
		<?php if(Yii::$app->params['showTopSearch'] != false):?>
		<div class="">
			<form class="myFilterForm input-icon" method="post">
				<div class="input-icon-addon">
					<span class="header-serach-btn">
						<i class="fe fe-search"></i>
					</span>
				</div>
				<input name="search" type="search" class="form-control header-search" placeholder="Tìm kiếm&hellip;"
					tabindex="1">
			</form>
		</div>
		<?php endif; ?>
		<div class="main-header-right ms-auto">
			<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto collapsed" type="button"
				data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
				aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon fe fe-more-vertical"></span>
			</button>
			<div class="navbar navbar-expand-lg navbar-collapse responsive-navbar p-0">
				<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
					<ul class="nav nav-item header-icons navbar-nav-right ms-auto">
						<!-- Country-selector-->
						<!-- <li class="dropdown header-language-selection">
							<a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
								<i class="bi bi-translate"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
								<ul class="header-dropdown-list">
									<li>
										<div class="dropdown-item d-flex align-items-center position-relative">
											<a href="#;" class="stretched-link"></a>
											<span>French</span>
										</div>
									</li>
									<li>
										<div class="dropdown-item d-flex align-items-center position-relative">
											<a href="#;" class="stretched-link"></a>
											<span>Germany</span>
										</div>
									</li>
									<li>
										<div class="dropdown-item d-flex align-items-center position-relative">
											<a href="#;" class="stretched-link"></a>
											<span>Italy</span>
										</div>
									</li>
									<li>
										<div class="dropdown-item d-flex align-items-center position-relative">
											<a href="#;" class="stretched-link"></a>
											<span>Russia</span>
										</div>
									</li>
									<li>
										<div class="dropdown-item d-flex align-items-center position-relative">
											<a href="#;" class="stretched-link"></a>
											<span>Spain</span>
										</div>
									</li>
								</ul>
							</div>
						</li>-->
						<!-- Country-selector-->
						<!-- Theme-Layout -->
						<li class="dropdown main-header-notification d-md-flex">
							<a class="nav-link icon theme-layout nav-link-bg layout-setting"
								href="javascript:void(0);">
								<span class="dark-layout"><i class="bi bi-cloud-moon"></i></span>
								<span class="light-layout"><i class="bi bi-cloud-sun"></i></span>
							</a>
						</li>
						<!-- Theme-Layout -->
						<li class="dropdown header-search">
							<a class="nav-link icon header-search" data-bs-toggle="dropdown" href="#">
								<i class="fe fe-search"></i>
							</a>
							<div class="dropdown-menu">
								<div class="main-form-search p-2">
									<input class="form-control" placeholder="Search" type="search">
									<button class="btn"><i class="fe fe-search mt-2 "></i></button>
								</div>
							</div>
						</li>
						<!-- CART -->
						<li class="dropdown  d-flex shopping-cart main-header-notification">
							<a class="nav-link icon" data-bs-toggle="dropdown" data-bs-auto-close="outside">
								<i class="bi bi-cart-check"></i>
								<span class="badge bg-warning header-badge">0</span>

							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
								<div class="header-navheading d-flex border-bottom mb-0 align-items-center">
									<h5 class="fw-semibold mb-0">Yêu cầu mua sắm (0)</h5>
									<a class="btn ripple btn-primary btn-sm ms-auto" href="#">Xem tất cả</a>
								</div>
								<div class="header-dropdown-list cart-list">
								    <!-- 
									<div class="dropdown-item d-flex border-bottom pb-1 align-items-center">
										<a href="product-cart.html" class="cart-link"></a>
										<div>
											<span class="avatar br-5 align-self-center cover-image"
												data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/products/3.jpg"></span>
										</div>
										<div class="ms-3">
											<p class="mb-0 tx-14 text-dark fw-medium">Flower Pot</p>
											<div class=" mb-0">
												<span class="tx-14  text-muted mb-0">$11549.00</span>
											</div>
										</div>
										<div class="ms-auto mt-2 cart-trash">
											<a href="#">
												<i class="fe fe-trash-2 text-danger fs-16"></i>
											</a>
										</div>
									</div>
									<div class="dropdown-item d-flex border-bottom pb-1 align-items-center">
										<a href="product-cart.html" class="cart-link"></a>
										<div>
											<span class="avatar br-5 align-self-center cover-image"
												data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/products/5.jpg"></span>
										</div>
										<div class="ms-3">
											<p class="mb-0 tx-14 text-dark fw-medium">Digital Camera </p>
											<div class="mb-0">
												<span class="tx-14  text-muted">$999.00</span>
											</div>
										</div>
										<div class="ms-auto mt-2 cart-trash">
											<a href="javascript:void(0)">
												<i class="fe fe-trash-2 text-danger fs-16"></i>
											</a>
										</div>
									</div>
									<div
										class="dropdown-item d-flex mb-0 pb-2 border-bottom align-items-center">
										<a href="product-cart.html" class="cart-link"></a>
										<div>
											<span class="avatar br-5 align-self-center cover-image"
												data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/products/1.jpg"></span>
										</div>
										<div class="ms-3">
											<p class="mb-0 tx-14 text-dark fw-medium">Women Party Wear Dress
											</p>
											<div class="d-flex mb-0">
												<span class="tx-14 text-muted">$30000.00</span>
											</div>
										</div>
										<div class="ms-auto mt-2 cart-trash">
											<a href="javascript:void(0)">
												<i class="fe fe-trash-2 text-danger fs-16"></i>
											</a>
										</div>
									</div>
									<div
										class="dropdown-item d-flex mb-0 pb-2 border-bottom align-items-center">
										<a href="product-cart.html" class="cart-link"></a>
										<div>
											<span class="avatar br-5 align-self-center cover-image"
												data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/products/7.jpg"></span>
										</div>
										<div class="ms-3">
											<p class="mb-0 tx-14 text-dark fw-medium">Stylish Ear Pods</p>
											<div class="d-flex mb-0">
												<span class="tx-14 text-muted">$3599.00</span>
											</div>
										</div>
										<div class="ms-auto mt-2 cart-trash">
											<a href="javascript:void(0)">
												<i class="fe fe-trash-2 text-danger fs-16"></i>
											</a>
										</div>
									</div>
									<div class="dropdown-item d-flex mb-0 pb-1 align-items-center">
										<a href="product-cart.html" class="cart-link"></a>
										<div>
											<span class="avatar br-5 align-self-center cover-image"
												data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/products/4.jpg"></span>
										</div>
										<div class="ms-3">
											<p class="mb-0 tx-14 text-dark fw-medium">Men's Shirt</p>
											<div class="d-flex mb-0">
												<span class="tx-14  text-muted">$999.00</span>
											</div>
										</div>
										<div class="ms-auto mt-2 cart-trash">
											<a href="javascript:void(0)">
												<i class="fe fe-trash-2 text-danger fs-16"></i>
											</a>
										</div>
									</div>-->
								</div>
								<div class="dropdown-footer d-flex align-items-center justify-content-between">
									<!-- <span class="fs-16 fw-semibold ms-2">Total :</span>
									<a class="btn ripple btn-info btn-sm float-end"
										href="product-checkout.html">
										<i class="fe fe-check-circle mx-1"></i>Checkout
									</a> -->
								</div>
							</div>
						</li>
						<!-- CART -->

						<!-- FULL SCREEN -->
						<li class="dropdown d-none d-md-flex mt-1">
							<a class="nav-link icon full-screen-link">
								<i class="bi bi-fullscreen-exit fullscreen-button floating" id="fullscreen-button"></i>
							</a>
						</li>
						<!-- NOTIFICATIONS -->
						<li class="dropdown main-header-notification d-flex">
							<a class="nav-link icon" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
								<i class="bi bi-bell"></i>
								<span class="pulse bg-secondary"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
								<div class="header-navheading d-flex border-bottom mb-0">
									<h6 class="fw-semibold mb-0 mt-1">Thông báo(0)</h6>
									<a class="btn ripple btn-primary btn-sm ms-auto"
										href="javascript:void(0);">Đánh dấu đã đọc</a>
								</div>
								<div class="header-dropdown-list notification-list">
									<!-- 
									<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
										<div class="main-img-user online"><img alt="avatar"
												src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
										</div>
										<div class="media-body ms-2">
											<p class="mb-1">Congratulate <strong>Olivia James</strong> For
												new<br> Template start</p>
											<span>feb 15 12:32pm</span>
										</div>
									</a>
									<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
										<div class="main-img-user online"><img alt="avatar"
												src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/12.jpg">
										</div>
										<div class="media-body ms-2">
											<p class="mb-1"><strong>Joshua Gray</strong> New Message
												Received</p>
											<span>feb 13 02:56am</span>
										</div>
									</a>
									<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
										<div class="main-img-user online"><img alt="avatar"
												src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg">
										</div>
										<div class="media-body ms-2">
											<p class="mb-1"><strong>Elizabeth Lewis</strong> added new
												schedule<br> realease</p>
											<span>feb 12 10:40am</span>
										</div>
									</a>
									<a href="view-mail.html" class="dropdown-item d-flex border-bottom pb-1">
										<div class="main-img-user online"><img alt="avatar"
												src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/4.jpg">
										</div>
										<div class="media-body ms-2">
											<p class="mb-1"><strong>Sonia Fraser</strong> Nemo enim
												voluptatem<br> sequi nesciunt</p>
											<span>Nov 3 10:21am</span>
										</div>
									</a>
									<a href="view-mail.html" class="dropdown-item d-flex pb-1">
										<div class="main-img-user online"><img alt="avatar"
												src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/8.jpg">
										</div>
										<div class="media-body ms-2">
											<p class="mb-1"><strong>Kevin James</strong> simply dummy text
												of<br> the printing</p>
											<span>Nov 14 12:40pm</span>
										</div>
									</a>-->
								</div>
								<div class="dropdown-footer">
									<a class="btn ripple btn-success btn-sm btn-block"
										href="#">Xem tất cả thông báo</a>
								</div>
							</div>
						</li>
						<!-- SHORTCUTS -->
						<!-- 
						<li class="dropdown main-header-notification shortcuts d-flex">
							<a class="nav-link icon" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
								<i class="bi bi-card-heading"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
								<div class="header-navheading d-flex border-bottom mb-0 align-items-center">
									<h5 class="fw-semibold mb-0">Shortcuts</h5>
								</div>
								<ul class="drop-icon-wrap">
									<li>
										<a href="mail-inbox.html" class="drop-icon-item">
											<i class="fe fe-mail text-dark"></i>
											<span class="d-block">E-mail</span>
										</a>
									</li>
									<li>
										<a href="full-calendar.html" class="drop-icon-item">
											<i class="fe fe-calendar text-dark"></i>
											<span class="d-block">calendar</span>
										</a>
									</li>
									<li>
										<a href="map-leaflet.html" class="drop-icon-item">
											<i class="fe fe-map-pin text-dark"></i>
											<span class="d-block">map</span>
										</a>
									</li>
									<li>
										<a href="product-cart.html" class="drop-icon-item">
											<i class="fe fe-shopping-cart text-dark"></i>
											<span class="d-block">Cart</span>
										</a>
									</li>
									<li>
										<a href="chat.html" class="drop-icon-item">
											<i class="fe fe-message-square text-dark"></i>
											<span class="d-block">chat</span>
										</a>
									</li>
									<li>
										<a href="contacts.html" class="drop-icon-item">
											<i class="fe fe-phone-outgoing text-dark"></i>
											<span class="d-block">contact</span>
										</a>
									</li>
								</ul>
							</div>
						</li>-->
						<!-- notification -->
						<!-- 
						<li class="dropdown header-settings">
							<a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right"
								data-bs-target=".sidebar-right">
								<i class="bi bi-text-indent-right"></i>
							</a>
						</li>
						 -->
						<li class="dropdown d-flex main-profile-menu">

							<a class="main-img-user d-flex" href="javascript:void(0);"
								data-bs-toggle="dropdown">
								<img alt="avatar" src="<?= Yii::getAlias('@web') ?>/uploads/icons/user.png">
							</a>

							<div class="dropdown-menu dropdown-menu-arrow">
								<div class="header-navheading">
									<h6 class="main-notification-title mb-1"><?= User::getCurrentUser()->username ?></h6>
									<span class="tx-13 text-muted"><?= User::getCurrentUser()->tenNhanVien ?></span>
									<!-- <br/><span class="tx-13 text-muted"><?= User::getCurrentUser()->chucVu ?></span>-->
								</div>
								<!-- <a class="dropdown-item border-top text-wrap" href="<?= Yii::getAlias('@web') ?>/user/info">
									<i class="fe fe-user"></i> <span class="lh-1">Thông tin</span>
								</a> -->
								<!-- <a class="dropdown-item text-wrap" href="<?= Yii::getAlias('@web') ?>/user/info-edit">
									<i class="fe fe-edit"></i> <span class="lh-1">Edit Profile</span>
								</a> -->
								<a class="dropdown-item text-wrap" href="<?= Yii::getAlias('@web') ?>/user/auth/change-own-password">
									<i class="fe fe-lock "></i> <span class="lh-1">Thay đổi mật khẩu</span>
								</a>
								<a class="dropdown-item text-wrap" href="<?= Yii::getAlias('@web') ?>/user/user/activity">
									<i class="fe fe-activity"></i> <span class="lh-1">Hoạt động gần đây</span>
								</a>
								<a class="dropdown-item text-wrap" href="<?= Yii::getAlias('@web') ?>/user/auth/logout">
									<i class="fe fe-power"></i> <span class="lh-1">Đăng xuất</span>
								</a>
							</div>

						</li>
					</ul>
				</div>
			</div>
			
			<!-- <div class="switcher-icon nav-link icon sidebar-right1  fe-spin">
				<i class="bi bi-gear  floating"></i>
			</div> -->
	
		</div>
	</div>
</div>
<!--Main Header -->