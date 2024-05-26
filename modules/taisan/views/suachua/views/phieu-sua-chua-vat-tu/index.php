<?php
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use cangak\ajaxcrud\CrudAsset; 
use cangak\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
use app\widgets\FilterFormWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\suachua\models\PhieuSuaChuaVatTuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vật tư sửa chữa cho '.$phieuSuaChua->thietBi->ten_thiet_bi;
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

Yii::$app->params['showSearch'] = true;
Yii::$app->params['showExport'] = true;

?>
<?= require(__DIR__.'/grid-view-pjax.php') ?>


<?php
    $searchContent = $this->render("_search", ["model" => $searchModel]);
    echo FilterFormWidget::widget(["content"=>$searchContent, "description"=>"Nhập thông tin tìm kiếm."]) 
?>