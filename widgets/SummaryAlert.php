<?php
namespace app\widgets;

use yii\base\Widget;

class SummaryAlert extends Widget{
    public $type='success';
    public $icon='fe fe-thumbs-up';
    public $textMain;
    public $textSummary;
    public $showCloseButton=true;
    
    public function init(){
        parent::init();
    }
    
    public function run(){
        $html = '<div class="alert alert-'.$this->type.' alert-dismissible fade show" role="alert">
					<span class="alert-inner--icon me-1"><i class="'.$this->icon.'"></i></span>
					<span class="alert-inner--text"><strong>'.$this->textMain.'</strong> 
					'.$this->textSummary.'</span>';
        if($this->showCloseButton){
            $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>';
        }
		$html .= '</div>';
        
        return $html;
    }
}
?>