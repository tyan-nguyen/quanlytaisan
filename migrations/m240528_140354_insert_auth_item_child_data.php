<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240528_140354_insert_auth_item_child_data
 */
class m240528_140354_insert_auth_item_child_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        [
            'name' => 'qXemDanhSachVatTu',
            'route' => '/kholuutru/dm-vat-tu/index',
            
        ],
        [
            'name' => 'qThemVatTu',
            'route' => '/kholuutru/dm-vat-tu/create',
            
        ],
        [
            'name' => 'qSuaVatTu',
            'route' => '/kholuutru/dm-vat-tu/update',
            
        ],
        [
            'name' => 'qXoaVatTu',
            'route' => '/kholuutru/dm-vat-tu/delete',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua/index',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuSuaChua',
            'route' => '/suachua/bao-gia-sua-chua/index',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuSuaChua',
            'route' => '/suachua/bao-gia-sua-chua/view',
            
        ],
        [
            'name' => 'qThemPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua/create',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua/update',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua/chi-tiet-phieu-sua-chua',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/ct-bao-gia-sua-chua/create',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/ct-bao-gia-sua-chua/update',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/ct-bao-gia-sua-chua/delete',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/ct-bao-gia-sua-chua/index',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua-vat-tu/create',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua-vat-tu/update',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua-vat-tu/delete',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua-vat-tu/index',
            
        ],
        
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/kholuutru/kho/get-vat-tu-list',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua-vat-tu/view',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/dungchung/hinh-anh/create-outer',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/dungchung/hinh-anh/update-outer',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/dungchung/hinh-anh/delete-outer',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/dungchung/tai-lieu/create-outer',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/dungchung/tai-lieu/update-outer',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/dungchung/tai-lieu/delete-outer',
            
        ],
        [
            'name' => 'qXoaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua/delete',
            
        ],
        [
            'name' => 'qSuaBaoGiaSuaChua',
            'route' => '/suachua/bao-gia-sua-chua/update',
            
        ],
        [
            'name' => 'qDuyetBaoGiaSuaChua',
            'route' => '/suachua/bao-gia-sua-chua/update',
            
        ],
        [
            'name' => 'qDuyetBaoGiaSuaChua',
            'route' => '/suachua/bao-gia-sua-chua/view',
            
        ],
        [
            'name' => 'qDuyetBaoGiaSuaChua',
            'route' => '/suachua/bao-gia-sua-chua/index',
            
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
        echo "m240528_140354_insert_auth_item_child_data cannot be reverted.\n";

        return false;
    }
    */
}
