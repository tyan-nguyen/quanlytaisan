<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Role;

/**
 * Class m240707_212848_insert_role_data_dieuchuyen
 */
class m240707_212848_insert_role_data_dieuchuyen extends Migration
{

    private $data = [
        [
            'name' => 'nQuanLyDieuChuyenThietBi',
            'type' => 1,
            'description' => 'Quản lý điều chuyển thiết bị',
            'childrenNames' => [
                'qXemDanhSachDieuChuyenThietBi',
                'qThemDieuChuyenThietBi',
                'qSuaDieuChuyenThietBi',
                'qXoaDieuChuyenThietBi',
                'qGuiDieuChuyenThietBi',
                'qDuyetDieuChuyenThietBi',
                'qXuatDieuChuyenThietBi',
            ],
        ],

        [
            'name' => 'nThemDieuChuyenThietBi',
            'type' => 1,
            'description' => 'Thêm phiếu điều chuyển thiết bị',
            'childrenNames' => [
                'qThemDieuChuyenThietBi',
                'qXemDanhSachDieuChuyenThietBi'
            ]
        ],
        [
            'name' => 'nDuyetDieuChuyenThietBi',
            'type' => 1,
            'description' => 'Duyệt phiếu điều chuyển thiết bị',
            'childrenNames' => [
                'qDuyetDieuChuyenThietBi',
                'qXemDanhSachDieuChuyenThietBi',
            ]
        ],

        [
            'name' => 'nGuiDieuChuyenThietBi',
            'type' => 1,
            'description' => 'Gửi phiếu điều chuyển thiết bị',
            'childrenNames' => [
                'qGuiDieuChuyenThietBi',
                'qXemDanhSachDieuChuyenThietBi',
            ]
        ],

        [
            'name' => 'nXuatDieuChuyenThietBi',
            'type' => 1,
            'description' => 'Xuất phiếu điều chuyển thiết bị',
            'childrenNames' => [
                'qXuatDieuChuyenThietBi',
                'qXemDanhSachDieuChuyenThietBi',
            ]
        ],
    ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $check = Role::find()->where([
            'in',
            'name',
            [
                'nQuanLyDieuChuyenThietBi',
                'nThemDieuChuyenThietBi',
                'nGuiDieuChuyenThietBi',
                'nDuyetDieuChuyenThietBi',
                'nXuatDieuChuyenThietBi'
            ]

        ])->count();

        if (!$check) {
            foreach ($this->data as $item) {
                $authItem = new Role();
                $authItem->name = $item['name'];
                $authItem->type = $item['type'];
                $authItem->description = $item['description'];
                $authItem->created_at = time();
                $authItem->updated_at = time();
                $authItem->save();
                Role::addChildren($item['name'], $item['childrenNames'], $throwException = false);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->data as $item) {
            Role::removeChildren($item['name'], $item['childrenNames'], $throwException = false);
        }
        Role::deleteAll(['name' => [
            'nQuanLyDieuChuyenThietBi',
            'nThemDieuChuyenThietBi',
            'nGuiDieuChuyenThietBi',
            'nDuyetDieuChuyenThietBi',
            'nXuatDieuChuyenThietBi'
        ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240707_212848_insert_role_data_dieuchuyen cannot be reverted.\n";

        return false;
    }
    */
}
