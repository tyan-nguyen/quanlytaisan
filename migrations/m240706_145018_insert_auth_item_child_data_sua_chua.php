<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240706_145018_insert_auth_item_child_data_sua_chua
 */
class m240706_145018_insert_auth_item_child_data_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua/print-view',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua/print-phieu-xuat-kho-view',
            
        ]
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
        echo "m240706_145018_insert_auth_item_child_data_sua_chua cannot be reverted.\n";

        return false;
    }
    */
}
