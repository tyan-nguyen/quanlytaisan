<!-- Sidemenu -->
<div class="sticky">
	<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
	<aside class="app-sidebar ps horizontal-main">
		<div class="app-sidebar__header">
			<a class="main-logo" href="<?= Yii::getAlias('@web/') ?>">
				<img src="<?= Yii::getAlias('@web') ?>/assets/images/brand/logo.png" class="desktop-logo desktop-logo-dark"
					alt="viboonlogo">
				<img src="<?= Yii::getAlias('@web') ?>/assets/images/brand/logo1.png" class="desktop-logo" alt="viboonlogo">
				<img src="<?= Yii::getAlias('@web') ?>/assets/images/brand/favicon.png" class="mobile-logo mobile-logo-dark"
					alt="viboonlogo">
				<img src="<?= Yii::getAlias('@web') ?>/assets/images/brand/favicon-1.png" class="mobile-logo" alt="viboonlogo">
			</a>
		</div>
		<div class="main-sidemenu">
			<div class="slide-left disabled" id="slide-left">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
					viewBox="0 0 24 24">
					<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
				</svg>
			</div>
			

			<ul class="side-menu">
				<li class="side-item side-item-category">Dashboard</li>
				<li>
					<a class="side-menu__item" data-bs-toggle="slide" href="#">
						<span class="side-menu__icon"><i class="bi bi-house-door side_menu_img"></i></span>
						<span class="side-menu__label">Dashboard</span>
					</a>
				</li>
				
				<li class="side-item side-item-category">Module</li>

				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
						<span class="side-menu__icon"><i class="bi bi-ui-checks-grid side_menu_img"></i></span>
						<span class="side-menu__label">Tài sản</span><i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side3" class="active" data-bs-toggle="tab"><i
													class="bi bi-house"></i>
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
											<li class="side-menu__label1"><a href="javascript:void(0)">Icons</a>
											</li>
											<li><a href="icons.html" class="slide-item">Fontawesome
													Icons</a></li>
											<li><a href="icons-2.html" class="slide-item">Ionicons Icons</a>
											</li>
											<li><a href="typ-icons.html" class="slide-item">Typicon
													Icons</a></li>
											<li><a href="feather-icons.html" class="slide-item">Feather
													Icons</a></li>
											<li><a href="material-icons.html" class="slide-item">MaterialDesign
													Icons</a></li>
											<li><a href="simple-icons.html" class="slide-item">Simpleline
													Icons</a></li>
											<li><a href="pe7-icons.html" class="slide-item">Pe7 Icons</a>
											</li>
											<li><a href="themify-icons.html" class="slide-item">Themify
													Icons</a></li>
											<li><a href="weather-icons.html" class="slide-item">Weather
													Icons</a></li>
											<li><a href="bootstrap-icons.html" class="slide-item">Bootstrap
													Icons</a></li>
											<li><a href="flags-icons.html" class="slide-item">Flag Icons</a>
											</li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="mt-3 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i
																class="fe fe-download text-primary text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="mt-3 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12"> Web Designer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side4">
										<h5 class="mt-3 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/10.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
						<span class="side-menu__icon"><i class="bi bi-pin-map side_menu_img"></i></span>
						<span class="side-menu__label">Phòng ban - Bộ phận</span><i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
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
											<li class="side-menu__label1"><a href="javascript:void(0)">Maps</a>
											</li>
											<li><a href="map-mapel.html" class="slide-item">Mapel Maps</a>
											</li>
											<li><a href="map-vector.html" class="slide-item">Vector Maps</a>
											</li>
											<li><a href="map-leaflet.html" class="slide-item">Leaflet
													Maps</a></li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="mt-3 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i
																class="fe fe-download text-primary text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="mt-3 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12"> Web Designer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side6">
										<h5 class="my-4 px-1 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/2.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/3.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
						<span class="side-menu__icon"><i class="bi bi-app-indicator side_menu_img"></i></span>
						<span class="side-menu__label">Apps</span><i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
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
											<li class="side-menu__label1"><a href="javascript:void(0)">Apps</a>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Mail</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="mail-inbox.html">Mail Inbox</a></li>
													<li><a class="sub-side-menu__item"
															href="mail-compose.html">Mail compose</a></li>
													<li><a class="sub-side-menu__item"
															href="view-mail.html">Mail View</a></li>
												</ul>
											</li>
											<li><a href="chat.html" class="slide-item">Chat</a></li>
											<li><a href="cards.html" class="slide-item">Cards</a></li>
											<li><a href="treeview.html" class="slide-item">Treeview</a></li>
											<li><a href="contacts.html" class="slide-item">Contacts</a></li>
											<li><a href="default-calendar.html" class="slide-item">Default
													Calendar</a></li>
											<li><a href="full-calendar.html" class="slide-item">Full
													Calendar</a></li>
											<li><a href="notifications.html"
													class="slide-item">Notifications</a></li>
											<li><a href="range-slider.html" class="slide-item">Range
													Sliders</a></li>
											<li><a href="footer.html" class="slide-item">Footers</a></li>
											<li><a href="crypto-currencies.html" class="slide-item">Crypto
													Currencies</a></li>
											<li><a href="colors.html" class="slide-item">Colors</a></li>
											<li><a href="offcanvas.html" class="slide-item">Offcanvas</a>
											</li>
											<li><a href="gallery.html" class="slide-item">Gallery</a></li>
											<li><a href="services.html" class="slide-item">Services</a></li>
											<li><a href="settings.html" class="slide-item">Settings</a></li>
											<li><a href="switcher.html" class="slide-item">Switcher</a></li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="my-4 px-1 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-download text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div
														class="d-flex   px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12"> Web Designer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side8">
										<h5 class="my-4 px-1 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/2.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/3.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				<li class="side-item side-item-category">Components</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
						<span class="side-menu__icon"><i class="bi bi-file-earmark-break side_menu_img"></i></span>
						<span class="side-menu__label">Pages</span><i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side9" class="active" data-bs-toggle="tab"><i
													class="bi bi-house"></i>
												<p>Home</p>
											</a></li>
										<li><a href="#side10" data-bs-toggle="tab"><i class="bi bi-box"></i>
												<p>Activity</p>
											</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active" id="side9">
										<ul class="sidemenu-list">
											<li class="side-menu__label1"><a href="javascript:void(0)">Pages</a>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">File Manager</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="file-manager.html">File Manager</a></li>
													<li><a class="sub-side-menu__item"
															href="file-manager-list.html">File Manager
															list</a></li>
													<li><a class="sub-side-menu__item"
															href="file-details.html">File Details</a></li>
													<li><a class="sub-side-menu__item"
															href="file-attachments.html">File
															Attachments</a></li>
												</ul>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">E Commerce</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="products.html">Products</a></li>
													<li><a class="sub-side-menu__item"
															href="product-details.html">product-details</a>
													</li>
													<li><a class="sub-side-menu__item"
															href="product-cart.html">Cart</a></li>
													<li><a class="sub-side-menu__item"
															href="product-wishlist.html">Wishlist</a></li>
													<li><a class="sub-side-menu__item"
															href="product-checkout.html">Checkout</a></li>
													<li><a class="sub-side-menu__item"
															href="add-product.html">Add Product</a></li>
												</ul>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Forms</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="form-elements.html">Form Elements</a></li>
													<li><a class="sub-side-menu__item"
															href="form-advanced.html">Advanced Forms</a>
													</li>
													<li><a class="sub-side-menu__item"
															href="form-layouts.html">Form Layouts</a></li>
													<li><a class="sub-side-menu__item"
															href="form-sizes.html">Form Element Sizes</a>
													</li>
													<li><a class="sub-side-menu__item"
															href="form-validation.html">Form Validation</a>
													</li>
													<li><a class="sub-side-menu__item"
															href="form-wizards.html">Form Wizards</a></li>
													<li><a class="sub-side-menu__item"
															href="form-editor.html">WYSIWYG Editor</a></li>
												</ul>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Tables</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="table-basic.html">Basic Tables</a></li>
													<li><a class="sub-side-menu__item"
															href="table-data.html">Data Tables</a></li>
													<li><a class="sub-side-menu__item"
															href="table-edit.html">Edit Tables</a></li>
												</ul>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Charts</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="chart-morris.html">Morris Charts</a></li>
													<li><a class="sub-side-menu__item"
															href="chart-flot.html">Flot Chats</a></li>
													<li><a class="sub-side-menu__item"
															href="chart-chartjs.html">Chartjs </a></li>
													<li><a class="sub-side-menu__item"
															href="chart-spark-peity.html">Sparkline &
															Peity</a></li>
													<li><a class="sub-side-menu__item"
															href="chart-echart.html">Echart</a></li>
												</ul>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Custom Pages</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item" href="signin.html">Sign
															In</a></li>
													<li><a class="sub-side-menu__item" href="signup.html">Sign
															Up</a></li>
													<li><a class="sub-side-menu__item" href="forgot.html">Forgot
															Password</a></li>
													<li><a class="sub-side-menu__item" href="reset.html">Reset
															Password</a></li>
													<li><a class="sub-side-menu__item"
															href="lockscreen.html">Lockscreen</a></li>
													<li><a class="sub-side-menu__item"
															href="underconstruction.html">Underconstruction</a>
													</li>
													<li><a class="sub-side-menu__item" href="404.html">404
															Error</a></li>
													<li><a class="sub-side-menu__item" href="500.html">500
															Error</a></li>
												</ul>
											</li>
											<li><a href="thumbnails.html" class="slide-item"> Thumbnails</a>
											</li>
											<li><a href="scrollspy.html" class="slide-item">Scrollspy</a>
											</li>
											<li><a href="media-object.html" class="slide-item">Media
													Object</a></li>
											<li><a href="profile.html" class="slide-item">Profile</a></li>
											<li><a href="invoice.html" class="slide-item">Invoice</a></li>
											<li><a href="pricing.html" class="slide-item">Pricing</a></li>
											<li><a href="faq.html" class="slide-item">Faqs</a></li>
											<li><a href="breadcrumbs.html" class="slide-item">Breadcrumbs</a>
											</li>
											<li><a href="terms.html" class="slide-item">Terms</a></li>
											<li><a href="about.html" class="slide-item">About</a></li>
											<li><a href="empty.html" class="slide-item">Empty Page</a></li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="my-4 px-1 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-download text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12"> Web Designer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side10">
										<h5 class="my-4 px-1 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/2.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/3.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
						<span class="side-menu__icon"><i class="bi bi-hdd-rack side_menu_img"></i></span>
						<span class="side-menu__label">Elements</span><i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side11" class="active" data-bs-toggle="tab"><i
													class="bi bi-house"></i>
												<p>Home</p>
											</a></li>
										<li><a href="#side12" data-bs-toggle="tab"><i class="bi bi-box"></i>
												<p>Activity</p>
											</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active" id="side11">
										<ul class="sidemenu-list">
											<li class="side-menu__label1"><a
													href="javascript:void(0)">Elements</a></li>
											<li><a href="avatar.html" class="slide-item">Avatars</a></li>
											<li><a href="alerts.html" class="slide-item">Alerts</a></li>
											<li><a href="buttons.html" class="slide-item">Buttons</a></li>
											<li><a href="badge.html" class="slide-item">Badges</a></li>
											<li><a href="dropdown.html" class="slide-item">Dropdowns</a>
											</li>
											<li><a href="list-group.html" class="slide-item">List Group</a>
											</li>
											<li><a href="navigation.html" class="slide-item">Navigation</a>
											</li>
											<li><a href="images.html" class="slide-item">Images</a></li>
											<li><a href="pagination.html" class="slide-item">Pagination</a>
											</li>
											<li><a href="popover.html" class="slide-item">Popover</a></li>
											<li><a href="progress.html" class="slide-item">Progress</a></li>
											<li><a href="ribbons.html" class="slide-item">Ribbons</a></li>
											<li><a href="spinners.html" class="slide-item">Spinners</a></li>
											<li><a href="typography.html" class="slide-item">Typography</a>
											</li>
											<li><a href="tooltip.html" class="slide-item">Tooltip</a></li>
											<li><a href="toast.html" class="slide-item">Toast</a></li>
											<li><a href="tags.html" class="slide-item">Tags</a></li>
											<li><a href="panels.html" class="slide-item">Panels</a></li>
											<li><a href="tabs.html" class="slide-item">Tabs</a></li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="my-4 px-1 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-download text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12">Web Designer</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side12">
										<h5 class="my-4 px-1 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/2.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/3.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
						<span class="side-menu__icon"><i class="bi bi-cpu side_menu_img"></i></span>
						<span class="side-menu__label">Advanced UI</span><i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side13" class="active" data-bs-toggle="tab"><i
													class="bi bi-house"></i>
												<p>Home</p>
											</a></li>
										<li><a href="#side14" data-bs-toggle="tab"><i class="bi bi-box"></i>
												<p>Activity</p>
											</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active" id="side13">
										<ul class="sidemenu-list">
											<li class="side-menu__label1"><a href="javascript:void(0)">Advanced
													UI</a></li>
											<li><a href="accordion.html" class="slide-item">Accordion</a>
											</li>
											<li><a href="carousel.html" class="slide-item">Carousel</a></li>
											<li><a href="collapse.html" class="slide-item">Collapse</a></li>
											<li><a href="modals.html" class="slide-item">Modals</a></li>
											<li><a href="timeline.html" class="slide-item">Timeline</a></li>
											<li><a href="draggablecards.html"
													class="slide-item">Draggable-Cards</a></li>
											<li><a href="sweet-alert.html" class="slide-item">Sweet-alert</a>
											</li>
											<li><a href="rating.html" class="slide-item">Ratings</a></li>
											<li><a href="counters.html" class="slide-item">counters</a></li>
											<li><a href="search.html" class="slide-item">search</a></li>
											<li><a href="userlist.html" class="slide-item">User List</a>
											</li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Blog</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="blog-page.html">Blog-Page</a></li>
													<li><a class="sub-side-menu__item"
															href="blog-details.html">Blog-Details</a></li>
													<li><a class="sub-side-menu__item"
															href="blog-post.html">Blog-Post</a></li>
												</ul>
											</li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="my-4 px-1 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-download text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12">Web Designer</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side14">
										<h5 class="my-4 px-1 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/2.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/3.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				<li class="side-item side-item-category">Other Pages</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
						<span class="side-menu__icon">
							<i class="bi bi-plus-square side_menu_img"></i>
						</span>
						<span class="side-menu__label">Sub Menus</span>
						<i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side15" class="active" data-bs-toggle="tab"><i
													class="bi bi-house"></i>
												<p>Home</p>
											</a></li>
										<li><a href="#side16" data-bs-toggle="tab"><i class="bi bi-box"></i>
												<p>Activity</p>
											</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active" id="side15">
										<ul class="sidemenu-list">
											<li class="side-menu__label1"><a href="javascript:void(0)">Menu
													Levels</a></li>
											<li><a class="slide-item" href="javascript:void(0)">Sub
													Menu-1</a></li>
											<li class="sub-slide">
												<a class="slide-item side-menu__item-sub"
													data-bs-toggle="sub-slide" href="javascript:void(0)">
													<span class="sub-side-menu__label">Sub Menu-2</span>
													<i class="sub-angle fe fe-chevron-right"></i>
												</a>
												<ul class="sub-slide-menu">
													<li><a class="sub-side-menu__item"
															href="javascript:void(0)">Sub Menu-2.1</a></li>
													<li><a class="sub-side-menu__item"
															href="javascript:void(0)">Sub Menu-2.2</a></li>
													<li class="sub-slide2">
														<a class="sub-side-menu__item side-menu__item-sub2"
															data-bs-toggle="sub-slide2"
															href="javascript:void(0)">
															<span class="sub-side-menu__label">Sub
																Menu-2.3</span>
															<i class="sub-angle fe fe-chevron-right"></i>
														</a>
														<ul class="sub-slide-menu1">
															<li><a class="sub-slide-item2"
																	href="javascript:void(0)">Sub
																	Menu-2.3.1</a></li>
															<li><a class="sub-slide-item2"
																	href="javascript:void(0)">Sub
																	Menu-2.3.2</a></li>
															<li><a class="sub-slide-item2"
																	href="javascript:void(0)">Sub
																	Menu-2.3.3</a></li>
														</ul>
													</li>
												</ul>
											</li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="my-4 px-1 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-download text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12">Web Designer</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side16">
										<h5 class="my-4 px-1 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/2.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/3.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="widgets.html">
						<span class="side-menu__icon">
							<i class="bi bi-columns side_menu_img"></i>
						</span>
						<span class="side-menu__label">Widgets</span>
					</a>
				</li>
				<li class="slide">
					<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
						<span class="side-menu__icon"><i class="bi bi-handbag side_menu_img"></i></span>
						<span class="side-menu__label">Utilities</span><i class="angle fe fe-chevron-right"></i>
					</a>
					<ul class="slide-menu">
						<li class="panel sidetab-menu">
							<div class="tab-menu-heading p-0 pb-2 border-0">
								<div class="tabs-menu ">
									<ul class="nav panel-tabs">
										<li><a href="#side17" class="active" data-bs-toggle="tab"><i
													class="bi bi-house"></i>
												<p>Home</p>
											</a></li>
										<li><a href="#side18" data-bs-toggle="tab"><i class="bi bi-box"></i>
												<p>Activity</p>
											</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body tabs-menu-body p-0 border-0">
								<div class="tab-content">
									<div class="tab-pane active" id="side17">
										<ul class="sidemenu-list">
											<li class="side-menu__label1"><a
													href="javascript:void(0)">Utilities</a></li>
											<li><a href="background.html" class="slide-item">Background</a>
											</li>
											<li><a href="border.html" class="slide-item">Border</a></li>
											<li><a href="display.html" class="slide-item">Display</a></li>
											<li><a href="flex.html" class="slide-item">Flex</a></li>
											<li><a href="height.html" class="slide-item">Height</a></li>
											<li><a href="margin.html" class="slide-item">Margin</a></li>
											<li><a href="padding.html" class="slide-item">Padding</a></li>
											<li><a href="position.html" class="slide-item">Position</a></li>
											<li><a href="width.html" class="slide-item">Width</a></li>
											<li><a href="extras.html" class="slide-item">Extras</a></li>
										</ul>
										<div class="menutabs-content px-0">
											<h5 class="my-4 px-1 text-defeult">Account</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-download text-primary"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Download
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-folder text-info"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Archive
															</div>
														</div>
													</div>
													<div
														class="d-flex px-0 py-2 align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-rss text-success"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Feed
																Manager
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-2">
															<i class="fe fe-settings text-warning"></i>
														</div>
														<div class="">
															<div class="font-weight-semibold fs-15">Settings
															</div>
														</div>
													</div>
												</div>
											</div>
											<h5 class="my-4 px-1 text-defeult">Contacts</h5>
											<div class="card-body p-0">
												<div class="list-group list-group-flush">
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/male/2.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Reynante Labares
																<p class="text-muted fs-12">Web Designer</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/11.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Socrates Itumay
																<p class="text-muted fs-12"> Php Developer
																</p>
															</div>
														</div>
													</div>
													<div class="d-flex  align-items-center border-bottom-0">
														<div class="me-3 mb-2">
															<span class="avatar rounded-circle cover-image"
																data-bs-image-src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg">
																<span class="avatar-status bg-green"></span>
															</span>
														</div>
														<div class="">
															<div class="font-weight-semibold mt-2 fs-15">
																Owen Bongcaras
																<p class="text-muted fs-12">Ui Developer</p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="side18">
										<h5 class="my-4 px-1 text-defeult">Activity</h5>
										<div class="activity mt-3">
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/1.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/2.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/3.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/4.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/5.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Adam Berry</b> Add a new
														Projects <b> AngularJS Template</b></p>
													<small class="text-muted ">30 mins ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/6.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Irene Hunter</b> Add a
														new Projects <b>Free HTML Template</b></p>
													<small class="text-muted ">1 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/7.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>John Payne</b> Add a new
														Projects <b>Free PSD Template</b></p>
													<small class="text-muted ">3 days ago</small>
												</div>
											</div>
											<img src="<?= Yii::getAlias('@web') ?>/assets/images/users/female/8.jpg" alt=""
												class="img-activity">
											<div class="time-activity">
												<div class="item-activity">
													<p class="mb-0 text-defeult"><b>Julia Hardacre</b> Add a
														new Projects <b>Free UI Template</b></p>
													<small class="text-muted ">5 days ago</small>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>

					</ul>
				</li>
				<li>
					<a class="side-menu__item help-support" href="https://support.spruko.com" target="_blank">
						<span class="side-menu__icon">
							<i class="bi bi-question-octagon side_menu_img"></i>
						</span>
						<span class="side-menu__label">Help & Support</span></a>
				</li>
			</ul>
			<div class="slide-right" id="slide-right">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
					viewBox="0 0 24 24">
					<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
					</path>
				</svg>
			</div>
		</div>
	</aside>
</div>
<!-- End Sidemenu -->