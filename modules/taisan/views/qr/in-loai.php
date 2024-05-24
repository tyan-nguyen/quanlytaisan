<?php 
    use yii\helpers\Html;

    foreach ($model as $i=>$loai){
        echo Html::a(
            '<i class="fa fa-print me-2"></i>' . $loai->ten_loai,
            [Yii::getAlias('@web/taisan/qr/in-loai'), 'idLoai'=>$loai->id] ,
            [
                "class"=>"dropdown-item",
                'role'=>'modal-remote',
            ]
        );
    
    }
?>