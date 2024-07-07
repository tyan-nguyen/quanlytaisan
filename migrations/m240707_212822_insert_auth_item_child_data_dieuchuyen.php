<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Route;
use webvimark\modules\UserManagement\models\rbacDB\Permission;

/**
 * Class m240707_212822_insert_auth_item_child_data_dieuchuyen
 */
class m240707_212822_insert_auth_item_child_data_dieuchuyen extends Migration
{
    /**
     * {@inheritdoc}
     */

    private $data = [
        [
            'name' => 'qXemDanhSachDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/index',
        ],
        [
            'name' => 'qThemDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/create',
        ],
        [
            'name' => 'qThemDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/update',
        ],
        [
            'name' => 'qSuaDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/update',
        ],
        [
            'name' => 'qXoaDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/delete',

        ],

        // Gui

        [
            'name' => 'qGuiDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/index',
        ],
        [
            'name' => 'qGuiDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/view',
        ],
        [
            'name' => 'qGuiDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/send-request',
        ],

        // Phe Duyet
        [
            'name' => 'qDuyetDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/index',
        ],
        [
            'name' => 'qDuyetDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/view',
        ],
        [
            'name' => 'qDuyetDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/approve',
        ],

        // Xuat va Van Hanh
        [
            'name' => 'qXuatDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/index',
        ],
        [
            'name' => 'qXuatDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/view',
        ],
        [
            'name' => 'qXuatDieuChuyenThietBi',
            'route' => '/taisan/yeu-cau-van-hanh/operate',
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

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240707_212822_insert_auth_item_child_data_dieuchuyen cannot be reverted.\n";

        return false;
    }
    */
}
