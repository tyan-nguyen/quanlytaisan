<?php 
use yii\helpers\ArrayHelper;
use app\modules\taisan\models\ThietBiBase;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin([
        	'id'=>'myFilterForm',
            'method' => 'get',
            'action'=>'/taisan/thong-ke/thong-ke-tai-san-hoat-dong?menu=ts9',
            'options' => [
                'class' => 'myFilterForm',
            ]
      	]); ?>
      	
<div class="row">
    <div class="col-md-2">
    	<label>Thiết bị</label><br/>
    	<?= Select2::widget([
            'name' => 'idThietBi',
    	    'value' => $idThietBi,
            'data' => ArrayHelper::map(ThietBiBase::find()->all(), 'id', 'ten_thiet_bi'),
            'options' => ['placeholder' => 'Chọn thiết bị ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'width' => '100%'
            ],
        ]);
        ?>
    </div>
    <div class="col-md-2">
    	<label>Từ ngày</label>
    	<?= DatePicker::widget([
            'name' => 'tuNgay',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => $tuNgay,
            'options' => [
                'placeholder' => 'Chọn ngày...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
                'width' => '100%'
            ]
        ]);?>
    </div>
    <div class="col-md-2">
    	<label>Đến ngày</label>
    	<?= DatePicker::widget([
            'name' => 'denNgay',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => $denNgay,
            'options' => [
                'placeholder' => 'Chọn ngày...',
            ],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy',
                'width' => '100%'
            ]
        ]);?>
    </div>
    
     <div class="col-md-4">
     	<br/>
     	<label>Hiển thị lịch sử bảo trì</label>
     	<?php 
     	  $firstLoad = false;
     	  if(!$showBaoTri && !$showSuaChua && !$showVanHanh){
     	      $firstLoad = true;
     	  }
     	?>
     	<?= Html::checkbox('showBaoTri', $firstLoad?true:$showBaoTri) ?>
    
     	<label>Hiển thị lịch sử sửa chữa</label>
     	<?= Html::checkbox('showSuaChua', $firstLoad?true:$showSuaChua) ?>
     
     	<label>Hiển thị lịch sử vận hành</label>
     	<?= Html::checkbox('showVanHanh', $firstLoad?true:$showVanHanh) ?>
     </div>
     <div class="col-md-2">
     	<br/>
     	<button type="submit" class="btn ripple btn-primary"><i class="fe fe-search"></i> Thống kê</button>
     </div>

</div> 
<?php ActiveForm::end(); ?>
