<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240702_133500_insert_auth_item_child_data_baotri
 */
class m240702_133500_insert_auth_item_child_data_baotri extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        
        [
            'name' => 'qXemDanhSachKeHoachBaoTri',
            'route' => '/baotri/ke-hoach-bao-tri/index',
            
        ],
        [
            'name' => 'qThemKeHoachBaoTri',
            'route' => '/baotri/ke-hoach-bao-tri/create',
            
        ],
        [
            'name' => 'qSuaKeHoachBaoTri',
            'route' => '/baotri/ke-hoach-bao-tri/update',
            
        ],
        [
            'name' => 'qXoaKeHoachBaoTri',
            'route' => '/baotri/ke-hoach-bao-tri/delete',
            
        ],
        [
            'name' => 'qXoaKeHoachBaoTri',
            'route' => '/baotri/ke-hoach-bao-tri/bulkdelete',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuBaoTri',
            'route' => '/baotri/lich-bao-tri/baotri',
            
        ],
        [
            'name' => 'qXemPhieuBaoTri',
            'route' => '/baotri/phieu-bao-tri/view',
            
        ],
        [
            'name' => 'qSuaPhieuBaoTri',
            'route' => '/baotri/phieu-bao-tri/update',
            
        ],
        [
            'name' => 'qXemLichBaoTri',
            'route' => '/baotri/lich-bao-tri/index',
            
        ],
        [
            'name' => 'qQuanLyDanhMucLoaiBaoTri',
            'route' => '/baotri/loai-bao-tri/*',
            
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
