<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240626_133500_insert_auth_item_child_data_muasam
 */
class m240701_133500_insert_auth_item_child_data_thietbi extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        
        [
            'name' => 'qQuanLyTaiSanCaNhan',
            'route' => '/taisan/thiet-bi/index-user',
            
        ],
        [
            'name' => 'qQuanLyTaiSanBoPhan',
            'route' => '/taisan/thiet-bi/index-bo-phan',
            
        ],
       
    ];
    public function safeUp()
    {
        Route::refreshRoutes();
        //sleep(3);
        foreach ($this->data as $item) {
            Permission::addChildren($item['name'], $item['route'], $throwException = false);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->data as $item) {
            Permission::removeChildren($item['name'], $item['route'], $throwException = false);
        }
    }
    
    /*
     // Use up()/down() to run migration code without a transaction.
     public function up()
     {
     
     }
     
     public function down()
     {
     echo "m240626_133500_insert_auth_item_child_data_muasam cannot be reverted.\n";
     
     return false;
     }
     */
}
