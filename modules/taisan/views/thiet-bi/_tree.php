<?php
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
use app\modules\taisan\models\HeThong;
use app\modules\taisan\models\LoaiThietBi;
use app\modules\bophan\models\BoPhan;

?>

<div class="card custom-card">
	<div class="card-header rounded-bottom-0 card-header bg-light text-dark">
		<h5 class="mt-2">
			<?php 
			switch ($tsLayout){
			    case 1:
			        echo 'Theo hệ thống';
			        break;
			    case 2:
			        echo 'Theo loại thiết bị';
			        break;
			    case 3:
			        echo 'Theo đơn vị quản lý';
			        break;
			    default:
			        echo '';
			}                    
			?>
		</h5>
	</div>
	<div class="card-body pe-0 ps-0 pt-0 pb-0">
	
	 <?php $form = ActiveForm::begin([
	        'id'=>'frmHeThong',
            'method' => 'post',
            'options' => [
                'class' => 'myFilterForm form-horizontal'
            ],
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => '<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-md-12 control-label'],
            ],
      	]); ?>	
      	
      	<?php Pjax::begin([
            'id'=>'myTree',
            'timeout' => 10000,
            'formSelector' => '.selectTreeForm'
        ]); ?>
        
        	<?php if($tsLayout==1):?>
			<input id="txtHidden" name="ThietBiSearch[id_he_thong]" type="hidden" value="" />
			<div data-bs-spy="scroll" data-bs-target="#navbar-example3" class="scrollspy-example-2 bd-x-0 bd-y-0 bg-white" style="height:600px;border-radius: 0px;" data-bs-offset="0" tabindex="0">
				
				<ul id="treeview1">    				
    				<?php 
    				    echo (new HeThong())->getListCTB();
    				?>    				
    			</ul>
    		</div>
			<?php endif; ?>
			
			<?php if($tsLayout==2):?>
			<input id="txtHidden" name="ThietBiSearch[id_loai_thiet_bi]" type="hidden" value="" />
			<div data-bs-spy="scroll" data-bs-target="#navbar-example3" class="scrollspy-example-2 bd-x-0 bd-y-0 bg-white" style="height:600px;border-radius: 0px;" data-bs-offset="0" tabindex="0">
				
				<ul id="treeview1">
    				<?php 
    				    echo (new LoaiThietBi())->getListCTB();
    				?> 
    			</ul>
    		</div>
			<?php endif; ?>
			
			<?php if($tsLayout==3):?>
			<input id="txtHidden" name="ThietBiSearch[id_bo_phan_quan_ly]" type="hidden" value="" />
			<div data-bs-spy="scroll" data-bs-target="#navbar-example3" class="scrollspy-example-2 bd-x-0 bd-y-0 bg-white" style="height:600px;border-radius: 0px;" data-bs-offset="0" tabindex="0">
				
				<ul id="treeview1">
    				<?php 
    				    echo (new BoPhan())->getListCTB();
    				?> 
    			</ul>
    		</div>
			<?php endif; ?>
			
		<?php Pjax::end(); ?>	
			
			<?php ActiveForm::end(); ?>
	</div>
</div>

<?php
$script = <<< JS
    $('#treeview1 li span.data').on('click', function(){
        //alert($(this).parent().attr('data-value'));
        var myVal = Number($(this).parent().attr('data-value'));
        if(myVal > 0) {
            $('#txtHidden').val(myVal);
            $('#frmHeThong').submit();
            $('#treeview1 li span.data').removeClass('hl-color');
            $(this).addClass('hl-color');
        }
    });
JS;
$this->registerJs($script);
?>


