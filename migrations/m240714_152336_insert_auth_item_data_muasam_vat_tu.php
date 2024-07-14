<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240714_152336_insert_auth_item_data_MuaSamVatTu_vat_tu
 */
class m240714_152336_insert_auth_item_data_muasam_vat_tu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            
            [
                'name' => 'qXemDanhSachPhieuMuaSamVatTu',
                'type' => 2,
                'description' => 'Xem danh sách phiếu mua sắm vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSamVatTu',
            ],
            [
                'name' => 'qThemPhieuMuaSamVatTu',
                'type' => 2,
                'description' => 'Thêm phiếu mua sắm vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSamVatTu',
            ],
            [
                'name' => 'qSuaPhieuMuaSamVatTu',
                'type' => 2,
                'description' => 'Sửa phiếu mua sắm vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSamVatTu',
            ],
            [
                'name' => 'qDuyetPhieuMuaSamVatTu',
                'type' => 2,
                'description' => 'Duyệt phiếu mua sắm vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSamVatTu',
            ],
            [
                'name' => 'qXoaPhieuMuaSamVatTu',
                'type' => 2,
                'description' => 'Xóa phiếu mua sắm vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSamVatTu',
            ],
            [
                'name' => 'qSuaBaoGiaMuaSamVatTu',
                'type' => 2,
                'description' => 'Sửa báo giá mua sắm vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSamVatTu',
            ],
            [
                'name' => 'qDuyetBaoGiaMuaSamVatTu',
                'type' => 2,
                'description' => 'Duyệt báo giá mua sắm vật tư',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSamVatTu',
            ],
        ];
        $check=Permission::find()->where([
            'in',
            'name',
            [
                'qXemDanhSachPhieuMuaSamVatTu',
                'qThemPhieuMuaSamVatTu',
                'qSuaPhieuMuaSamVatTu',
                'qXoaPhieuMuaSamVatTu',
                'qSuaBaoGiaMuaSamVatTu',
                'qDuyetBaoGiaMuaSamVatTu'
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
            'qXemDanhSachPhieuMuaSamVatTu',
            'qThemPhieuMuaSamVatTu',
            'qSuaPhieuMuaSamVatTu',
            'qXoaPhieuMuaSamVatTu',
            'qSuaBaoGiaMuaSamVatTu',
            'qDuyetBaoGiaMuaSamVatTu'
            ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240714_152336_insert_auth_item_data_MuaSamVatTu_vat_tu cannot be reverted.\n";

        return false;
    }
    */
}
