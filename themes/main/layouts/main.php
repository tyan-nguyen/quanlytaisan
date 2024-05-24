<?php 
use app\assets\ViboonAsset;
use yii\helpers\Html;
use app\modules\taisan\models\ThietBi;
use yii\bootstrap5\ActiveForm;

ViboonAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/assets/images/brand/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="vi" dir="ltr">
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="<?= Yii::getAlias('@web')  ?>/assets/images/brand/favicon.ico" >
		<!-- Title -->
		<title><?= Html::encode($this->title) ?></title>
		<?php $this->head() ?>
	</head>	
	
    <body class="app sidebar-mini">
    	<?php $this->beginBody() ?>
    	
    	<!-- switcher -->
    	<?php // $this->render('_switcher') ?>
    	<!-- end switcher -->
    	
    	<!-- Loader -->
		<div id="global-loader">
			<img src="<?= Yii::getAlias('@web')  ?>/assets/images/svgs/loader.svg" alt="loader">
		</div>
    	<!-- /Loader -->
    
		<!-- Page -->
		<div class="page">

            <?= $this->render('_top') ?>		
            
            <?= $this->render('_left') ?>
            
            <!-- Main Content-->
            <div class="main-content side-content pt-0">
            	<div class="side-app">
            
            		<div class="main-container container-fluid">
            
            			<!-- Page Header -->
            			<div class="page-header">
            				<div>
            					<h2 class="main-content-title tx-20 mg-b-5"><?= $this->title ?></h2>
            					<ol class="breadcrumb">
            						<li class="breadcrumb-item"><a href="javascript:void(0);"><?= Yii::$app->params['moduleID'] ?></a></li>
            						<li class="breadcrumb-item active" aria-current="page"><?= Yii::$app->params['modelID'] ?></li>
            					</ol>
            				</div>
            				<div class="d-flex">
            					<?php /* if(Yii::$app->params['showExport'] == true) {?>
            					<div class="me-2">
            						<a class="btn ripple btn-primary dropdown-toggle mb-0" href="javascript:void(0);"
            							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            							<i class="fe fe-external-link"></i> Export <i class="fa fa-caret-down ms-1"></i>
            						</a>
            						<div class="dropdown-menu tx-13">
            							<a class="dropdown-item" href="javascript:void(0);"><i
            									class="fa fa-file-pdf-o me-2"></i>Export as
            								Pdf</a>
            							<a class="dropdown-item" href="javascript:void(0);"><i
            									class="fa fa-image me-2"></i>Export as
            								Image</a>
            							<a class="dropdown-item" href="javascript:void(0);"><i
            									class="fa fa-file-excel-o me-2"></i>Export as
            								Excel</a>
            						</div>
            					</div>
            					<?php }*/ ?>
            					
            					<?php if(Yii::$app->controller->id == ThietBi::MODEL_ID && Yii::$app->controller->action->id == 'index'): ?>
            					<div class="me-2">
            						<a class="btn ripple btn-primary dropdown-toggle mb-0" href="javascript:void(0);"
            							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            							<i class="fe fe-list"></i> Hiển thị cây thiết bị <i class="fa fa-caret-down ms-1"></i>
            						</a>
            						<div class="dropdown-menu tx-13" style="min-width:200px">
            							<a class="dropdown-item" href="?layout=1"><i class="fe fe-layers"></i> Theo hệ thống</a>
            							<a class="dropdown-item" href="?layout=2"><i class="fe fe-layers"></i> Theo loại thiết bị</a>            									
            							<a class="dropdown-item" href="?layout=3"><i class="fe fe-layers"></i> Theo đơn vị quản lý</a>
            							<a class="dropdown-item" href="?layout=0"><i class="fe fe-x"></i> Tắt hiển thị cây thiết bị</a>
            						</div>
            					</div>
            					
            					<!-- 
            					<div class="dropdown">
                                  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                    Dropdown form
                                  </button>
                                  <?php $form = ActiveForm::begin([
                            	        'id'=>'frmTree',
                                        'method' => 'post',
                                        'options' => [
                                            'class' => 'selectTreeForm dropdown-menu mb-4'
                                        ],
                                        'layout' => 'horizontal',
                                        'fieldConfig' => [
                                            'template' => '<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}{error}</div>',
                                            'labelOptions' => ['class' => 'col-md-12 control-label'],
                                        ],
                                  	]); ?>	
                             
                                    <div class="mb-3">
                                      <label for="exampleDropdownFormEmail2" class="form-label">Email address</label>
                                      <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleDropdownFormPassword2" class="form-label">Password</label>
                                      <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
                                    </div>
                                    <div class="mb-3">
                                      <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                                        <label class="form-check-label" for="dropdownCheck2">
                                          Remember me
                                        </label>
                                      </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                 
                                  <?php ActiveForm::end(); ?>
                                  
                                </div>
                                 -->
            					<?php endif;?>
            					
            					<?php if(Yii::$app->params['showImport'] == true):?>
            					<div class="me-2">
            						<a class="btn ripple btn-primary dropdown-toggle mb-0" href="javascript:void(0);"
            							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            							<i class="fe fe-upload"></i> Import <i class="fa fa-caret-down ms-1"></i>
            						</a>
            						<div class="dropdown-menu tx-13" style="min-width:200px">
            							<a class="dropdown-item" href="<?= Yii::$app->params['showImportDownload'] ?>" target="_blank"><i
            									class="fe fe-download-cloud me-2"></i>Download file mẫu</a>
            							<a class="dropdown-item" href="<?= Yii::getAlias('@web/dungchung/import/upload?type='.Yii::$app->params['showImportModel']) ?>" role="modal-remote"><i
            									class="fe fe-upload-cloud me-2"></i>Upload file dữ liệu</a>
            						</div>
            					</div>
            					<?php endif; ?>
            					
            					<?php if(Yii::$app->params['showSearch'] == true) {?>
            					<div>            						
            						<a id="btnFilter" href="javascript:void(0);"
            							class="btn ripple btn-secondary navresponsive-toggler mb-0 off-canvas"
            							data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            							aria-expanded="false"
            							aria-label="Toggle navigation">
            							<i class="fe fe-filter me-1"></i> <?= (Yii::$app->params['searchLabel'] !=null ? Yii::$app->params['searchLabel'] : 'Tìm kiếm nâng cao') ?>
            						</a>
            					</div>
            					<?php } ?>
            				</div>
            			</div>
            			<!-- End Page Header -->
            
            			<!-- Row -->
            			<div class="row sidemenu-height">
            				<div class="col-lg-12">
            					<!-- <div class="card custom-card"> -->
            						<!-- <div class="card-body">-->
            							<?= $content ?>
            						<!-- </div>-->
            					<!-- </div>-->
            				</div>
            			</div>
            			<!-- End Row -->
            
            		</div>
            	</div>
            </div>
            <!-- End Main Content-->      		
    
    		<?= $this->render('_slidebar') ?>		
    
    		<?= $this->render('_footer') ?>
    		
		</div>
		<!-- Back to top -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
		
		<?php $this->endBody() ?>
		
	</body>
</html>
<?php $this->endPage() ?>		