<?php 
use app\modules\user\models\Dashboard;
use yii\bootstrap5\Modal;
use cangak\ajaxcrud\CrudAsset; 

Yii::$app->params['showTopSearch'] = false;
Yii::$app->params['moduleID'] = 'Home';
Yii::$app->params['modelID'] = 'Dashboard';
CrudAsset::register($this);
$dash = new Dashboard();
?>

<div class="row row-cards">
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumTaiSanDangHoatDong', compact('dash')) ?>
	</div>
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumLoaiCoGioi', compact('dash')) ?>
	</div>
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumVanChuyen', compact('dash')) ?>
	</div>
	<div class="col-sm-12 col-lg-3">
		<?= $this->render('_sumThietBi', compact('dash')) ?>
	</div>
</div>

<div class="row">
	<div class="col-xl-4 col-lg-12 col-md-12">
		<?= $this->render('_box-1', compact('dash')) ?>
	</div>
	<div class="col-xl-4 col-lg-12 col-md-12">
		<?= $this->render('_box-2', compact('dash')) ?>
	</div>
	<div class="col-xl-4 col-lg-12 col-md-12">
		<?= $this->render('_box-3', compact('dash')) ?>
	</div>
</div>

<?php Modal::begin([
   'options' => [
        'id'=>'ajaxCrudModal',
        'tabindex' => false // important for Select2 to work properly
   ],
   'dialogOptions'=>['class'=>'modal-xl'],
   'headerOptions'=>['class'=>'text-primary'],
   'titleOptions'=>['class'=>'text-primary'],
   'closeButton'=>['label'=>'<span aria-hidden=\'true\'>×</span>'],
   'id'=>'ajaxCrudModal',
   'footer'=>'',// always need it for jquery plugin
])?>

<?php Modal::end(); ?>