<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240626_133429_insert_auth_item_data_muasam
 */
class m240626_133429_insert_auth_item_data_muasam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            
            [
                'name' => 'qXemDanhSachPhieuMuaSam',
                'type' => 2,
                'description' => 'Xem danh sách phiếu mua sắm',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSam',
            ],
            [
                'name' => 'qThemPhieuMuaSam',
                'type' => 2,
                'description' => 'Thêm phiếu mua sắm',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSam',
            ],
            [
                'name' => 'qSuaPhieuMuaSam',
                'type' => 2,
                'description' => 'Sửa phiếu mua sắm',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSam',
            ],
            [
                'name' => 'qDuyetPhieuMuaSam',
                'type' => 2,
                'description' => 'Duyệt phiếu mua sắm',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSam',
            ],
            [
                'name' => 'qXoaPhieuMuaSam',
                'type' => 2,
                'description' => 'Xóa phiếu mua sắm',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSam',
            ],
            [
                'name' => 'qSuaBaoGiaMuaSam',
                'type' => 2,
                'description' => 'Sửa báo giá mua sắm',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSam',
            ],
            [
                'name' => 'qDuyetBaoGiaMuaSam',
                'type' => 2,
                'description' => 'Duyệt báo giá mua sắm',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyPhieuMuaSam',
            ],
        ];
        $check=Permission::find()->where([
            'in',
            'name',
            [
                'qXemDanhSachPhieuMuaSam',
                'qThemPhieuMuaSam',
                'qSuaPhieuMuaSam',
                'qXoaPhieuMuaSam',
                'qSuaBaoGiaMuaSam',
                'qDuyetBaoGiaMuaSam'
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
            'qXemDanhSachPhieuMuaSam',
            'qThemPhieuMuaSam',
            'qSuaPhieuMuaSam',
            'qXoaPhieuMuaSam',
            'qSuaBaoGiaMuaSam',
            'qDuyetBaoGiaMuaSam'
            ]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240626_133429_insert_auth_item_data_muasam cannot be reverted.\n";

        return false;
    }
    */
}
