<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Permission;

/**
 * Class m240528_132744_insert_auth_item_data
 */
class m240528_132744_insert_auth_item_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            [
                'name' => 'qXemDanhSachVatTu',
                'type' => 2,
                'description' => 'Quyền xem danh sách vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDmVatTu',
            ],
            [
                'name' => 'qThemVatTu',
                'type' => 2,
                'description' => 'Thêm vật tư kho',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDmVatTu',
            ],
            [
                'name' => 'qSuaVatTu',
                'type' => 2,
                'description' => 'Cập nhật vật tư kho',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDmVatTu',
            ],
            [
                'name' => 'qXoaVatTu',
                'type' => 2,
                'description' => 'Xóa vật tư kho',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyDmVatTu',
            ],
            [
                'name' => 'qXemDanhSachPhieuSuaChua',
                'type' => 2,
                'description' => 'Xem danh sách phiếu sửa chữa',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuSuaChua',
            ],
            [
                'name' => 'qThemPhieuSuaChua',
                'type' => 2,
                'description' => 'Thêm phiếu sửa chữa',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuSuaChua',
            ],
            [
                'name' => 'qSuaPhieuSuaChua',
                'type' => 2,
                'description' => 'Sửa phiếu sửa chữa',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuSuaChua',
            ],
            [
                'name' => 'qXoaPhieuSuaChua',
                'type' => 2,
                'description' => 'Xóa phiếu sửa chữa',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuSuaChua',
            ],
            [
                'name' => 'qSuaBaoGiaSuaChua',
                'type' => 2,
                'description' => 'Sửa báo giá sửa chữa',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuSuaChua',
            ],
            [
                'name' => 'qDuyetBaoGiaSuaChua',
                'type' => 2,
                'description' => 'Duyệt báo giá sửa chữa',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuSuaChua',
            ],
        ];
        $check=Permission::find()->where([
            'in',
            'name',
            [
                'qXemDanhSachVatTu',
                'qThemVatTu',
                'qSuaVatTu',
                'qXoaVatTu',
                'qXemDanhSachPhieuSuaChua',
                'qThemPhieuSuaChua',
                'qSuaPhieuSuaChua',
                'qXoaPhieuSuaChua',
                'qSuaBaoGiaSuaChua',
                'qDuyetBaoGiaSuaChua'
            ]

            ])->count();
        if(!$check)
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
            'qXemDanhSachVatTu',
            'qThemVatTu',
            'qSuaVatTu',
            'qXoaVatTu',
            'qXemDanhSachPhieuSuaChua',
            'qThemPhieuSuaChua',
            'qSuaPhieuSuaChua',
            'qXoaPhieuSuaChua',
            'qSuaBaoGiaSuaChua',
            'qDuyetBaoGiaSuaChua'
            ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240528_132744_insert_auth_item_child_data cannot be reverted.\n";

        return false;
    }
    */
}