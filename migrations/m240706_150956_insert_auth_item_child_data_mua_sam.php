<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240706_150956_insert_auth_item_child_data_mua_sam
 */
class m240706_150956_insert_auth_item_child_data_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        
        [
            'name' => 'qDuyetPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/duyet-phieu-mua-sam',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/gui-bao-gia',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/create',
            
        ],
    ];
    public function safeUp()
    {
        Route::refreshRoutes();
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
        echo "m240706_150956_insert_auth_item_child_data_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
