<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240626_133500_insert_auth_item_child_data_muasam
 */
class m240626_133500_insert_auth_item_child_data_muasam extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        
        [
            'name' => 'qXemDanhSachPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/index',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/index',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/view',
            
        ],
        [
            'name' => 'qThemPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/create',
            
        ],
        [
            'name' => 'qThemPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/update',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/update',
            
        ],
        [
            'name' => 'qDuyetPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/update',
            
        ],
        [
            'name' => 'qDuyetPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/index',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam',
            
        ],
        [
            'name' => 'qDuyetPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam',
            
        ],
        [
            'name' => 'qThemPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam',
            
        ],
        [
            'name' => 'qThemPhieuMuaSam',
            'route' => '/muasam/ct-phieu-mua-sam',
            
        ],
        [
            'name' => 'qThemPhieuMuaSam',
            'route' => '/muasam/ct-phieu-mua-sam/*',
            
        ],
        
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/muasam/phieu-nhap-hang/*',
            
        ],  
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/muasam/ct-phieu-nhap-hang/*',
            
        ],  
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/muasam/ct-bao-gia-mua-sam/*',
            
        ],    
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/dungchung/hinh-anh/create-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/dungchung/hinh-anh/update-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/dungchung/hinh-anh/delete-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/dungchung/tai-lieu/create-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/dungchung/tai-lieu/update-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSam',
            'route' => '/dungchung/tai-lieu/delete-outer',
            
        ],
        [
            'name' => 'qXoaPhieuMuaSam',
            'route' => '/muasam/phieu-mua-sam/delete',
            
        ],
        [
            'name' => 'qSuaBaoGiaMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/update',
            
        ],
        [
            'name' => 'qDuyetBaoGiaMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/update',
            
        ],
        [
            'name' => 'qDuyetBaoGiaMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/view',
            
        ],
        [
            'name' => 'qDuyetBaoGiaMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/index',
            
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
        echo "m240626_133500_insert_auth_item_child_data_muasam cannot be reverted.\n";

        return false;
    }
    */
}
