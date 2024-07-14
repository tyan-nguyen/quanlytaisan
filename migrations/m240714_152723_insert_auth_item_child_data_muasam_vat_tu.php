<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240714_152723_insert_auth_item_child_data_muasam_vat_tu
 */
class m240714_152723_insert_auth_item_child_data_muasam_vat_tu extends Migration
{
    /**
     * {@inheritdoc}
     */
    private $data=[
        
        [
            'name' => 'qXemDanhSachPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/list-mua-sam-vat-tu',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuMuaSamVatTu',
            'route' => '/muasam/bao-gia-mua-sam/index',
            
        ],
        [
            'name' => 'qXemDanhSachPhieuMuaSamVatTu',
            'route' => '/muasam/bao-gia-mua-sam/view',
            
        ],
        [
            'name' => 'qThemPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/create-vt',
            
        ],
        [
            'name' => 'qThemPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/create',
            
        ],
        [
            'name' => 'qThemPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/update',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/update',
            
        ],
        [
            'name' => 'qDuyetPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/update',
            
        ],
        [
            'name' => 'qDuyetPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/index',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam',
            
        ],
        [
            'name' => 'qDuyetPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam',
            
        ],
        [
            'name' => 'qThemPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/chi-tiet-phieu-mua-sam',
            
        ],
        [
            'name' => 'qThemPhieuMuaSamVatTu',
            'route' => '/muasam/ct-phieu-mua-sam-vt/*',
            
        ],
        
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-nhap-hang/*',
            
        ],  
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/ct-phieu-nhap-hang-vt/*',
            
        ],  
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/ct-bao-gia-mua-sam-vt/*',
            
        ],    
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/bao-gia-mua-sam/create',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/phieu-mua-sam/gui-bao-gia',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/muasam/bao-gia-mua-sam/delete',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/dungchung/hinh-anh/create-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/dungchung/hinh-anh/update-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/dungchung/hinh-anh/delete-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/dungchung/tai-lieu/create-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/dungchung/tai-lieu/update-outer',
            
        ],
        [
            'name' => 'qSuaPhieuMuaSamVatTu',
            'route' => '/dungchung/tai-lieu/delete-outer',
            
        ],
        [
            'name' => 'qXoaPhieuMuaSamVatTu',
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
            
        ],
        [
            'name' => 'qDuyetBaoGiaMuaSam',
            'route' => '/muasam/bao-gia-mua-sam/index',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua-vat-tu/create2',
            
        ],
        [
            'name' => 'qSuaPhieuSuaChua',
            'route' => '/suachua/phieu-sua-chua-vat-tu/update2',
            
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
        echo "m240714_152723_insert_auth_item_child_data_muasam_vat_tu cannot be reverted.\n";

        return false;
    }
    */
}
