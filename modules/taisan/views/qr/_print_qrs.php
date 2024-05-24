<?php
use yii\helpers\Html;
?>
<link href="/css/print-display.css" rel="stylesheet">
<div class="row text-center">
    <div class="col-md-12">    
    <h3 class="text-primary">DANH SÁCH IN TEM</h3>
    <h4>(<?= $tieuDe ?>)</h4>
        <div id="print">        
            <?php 
            $count = count($models);
            //echo $count . '.....................';
            foreach ($models as $index=>$model){
                    if($index == 0){
                        echo '<div class="wrap">';
                    } else {
                        echo $index%2==0?'<div class="wrap wrap2">':'';
                    }
           ?>
                <div class="div-<?= $index%2==0?'left':'right' ?>">
                <table>
                <tr>
                	<td><?= Html::img($model->qrCode, ['class'=>'img']) ?></td>
                	<td class="title"><?= $model->ten_thiet_bi ?></td>
                </tr>
                <tr>
                <td colspan="2" align="center" class="title-2">DNTN SX-TM Nguyễn Trình</td>
                </tr>
                </table>
                </div>
          <?php  
                if($index%2==1 || ($index+1)==$count){
                    echo '</div>';
                }
                 if($index%2==1){
                    echo '<div class="clearfix"></div>';
                }
                
            }
            ?> 
        
        </div><!-- print  -->
    </div>
</div> <!-- row -->