<?php

use yii\db\Migration;
use webvimark\modules\UserManagement\models\rbacDB\Permission;
/**
 * Class m240626_133429_insert_auth_item_data_muasam
 */
class m240702_133429_insert_auth_item_data_baotri extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [
            
            [
                'name' => 'qXemDanhSachKeHoachBaoTri',
                'type' => 2,
                'description' => 'Xem danh sách Kế hoạch bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qThemKeHoachBaoTri',
                'type' => 2,
                'description' => 'Thêm Kế hoạch bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qSuaKeHoachBaoTri',
                'type' => 2,
                'description' => 'Sửa Kế hoạch bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qXoaKeHoachBaoTri',
                'type' => 2,
                'description' => 'Xóa Kế hoạch bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qXemDanhSachPhieuBaoTri',
                'type' => 2,
                'description' => 'Xem danh sách Phiếu bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qXemPhieuBaoTri',
                'type' => 2,
                'description' => 'Xem phiếu bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qSuaPhieuBaoTri',
                'type' => 2,
                'description' => 'Sửa phiếu bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qXemLichBaoTri',
                'type' => 2,
                'description' => 'Xem lịch bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
            [
                'name' => 'qQuanLyDanhMucLoaiBaoTri',
                'type' => 2,
                'description' => 'Quản lý danh mục loại bảo trì',
                'created_at' => time(),
                'updated_at' => time(),
                'group_code' => 'quanLyBaoTri',
            ],
        ];
        $check=Permission::find()->where([
            'in',
            'name',
            [
                'qXemDanhSachKeHoachBaoTri',
                'qThemKeHoachBaoTri',
                'qSuaKeHoachBaoTri',
                'qXoaKeHoachBaoTri',
                'qXemDanhSachPhieuBaoTri',
                'qXemPhieuBaoTri',
                'qSuaPhieuBaoTri',
                'qXemLichBaoTri',
                'qQuanLyDanhMucLoaiBaoTri'
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
            'qXemDanhSachKeHoachBaoTri',
            'qThemKeHoachBaoTri',
            'qSuaKeHoachBaoTri',
            'qXoaKeHoachBaoTri',
            'qXemDanhSachPhieuBaoTri',
            'qXemPhieuBaoTri',
            'qSuaPhieuBaoTri',
            'qXemLichBaoTri',
            'qQuanLyDanhMucLoaiBaoTri'
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
