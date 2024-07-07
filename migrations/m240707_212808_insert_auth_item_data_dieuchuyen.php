<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Permission;

/**
 * Class m240707_212808_insert_auth_item_data_dieuchuyen
 */
class m240707_212808_insert_auth_item_data_dieuchuyen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            [
                'name' => 'qXemDanhSachDieuChuyenThietBi',
                'type' => 2,
                'description' => 'Xem danh sách điều chuyển thiết bị',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDieuChuyenThietBi',
            ],
            [
                'name' => 'qThemDieuChuyenThietBi',
                'type' => 2,
                'description' => 'Thêm phiếu điều chuyển thiết bị',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDieuChuyenThietBi',
            ],
            [
                'name' => 'qSuaDieuChuyenThietBi',
                'type' => 2,
                'description' => 'Sửa điều chuyển thiết bị',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDieuChuyenThietBi',
            ],
            [
                'name' => 'qXoaDieuChuyenThietBi',
                'type' => 2,
                'description' => 'Xóa điều chuyển thiết bị',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDieuChuyenThietBi',
            ],
            [
                'name' => 'qGuiDieuChuyenThietBi',
                'type' => 2,
                'description' => 'Gửi điều chuyển thiết bị',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDieuChuyenThietBi',
            ],
            [
                'name' => 'qDuyetDieuChuyenThietBi',
                'type' => 2,
                'description' => 'Duyệt điều chuyển thiết bị',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDieuChuyenThietBi',
            ],

            [
                'name' => 'qXuatDieuChuyenThietBi',
                'type' => 2,
                'description' => 'Xuat điều chuyển thiết bị',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDieuChuyenThietBi',
            ],

        ];

        $check = Permission::find()->where([
            'in',
            'name',
            [
                'qXemDanhSachDieuChuyenThietBi',
                'qThemDieuChuyenThietBi',
                'qSuaDieuChuyenThietBi',
                'qXoaDieuChuyenThietBi',
                'qGuiDieuChuyenThietBi',
                'qDuyetDieuChuyenThietBi',
                'qXuatDieuChuyenThietBi',

            ]

        ])->count();
        if (!$check)
            foreach ($data as $item) {
                $authItem = new Permission();
                $authItem->name = $item['name'];
                $authItem->type = $item['type'];
                $authItem->description = $item['description'];
                $authItem->created_at = $item['created_at'];
                $authItem->updated_at = $item['updated_at'];
                $authItem->group_code = $item['group_code'];
                $authItem->save();
            }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Permission::deleteAll(['name' => [
            'qXemDanhSachDieuChuyenThietBi',
            'qThemDieuChuyenThietBi',
            'qSuaDieuChuyenThietBi',
            'qXoaDieuChuyenThietBi',
            'qGuiDieuChuyenThietBi',
            'qDuyetDieuChuyenThietBi',
            'qXuatDieuChuyenThietBi',
        ]]);

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240707_212808_insert_auth_item_data_dieuchuyen cannot be reverted.\n";

        return false;
    }
    */
}
