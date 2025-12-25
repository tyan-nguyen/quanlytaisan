<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class PublicController extends Controller
{
    public $freeAccessActions = ['info'];
    
    public function behaviors()
    {
    	return [
    		'ghost-access'=> [
    			'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
    		],
    	];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionInfo($item)
    {
        $this->layout = 'public';
        return $this->render('info');
    }

}
