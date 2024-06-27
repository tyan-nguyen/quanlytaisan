<?php

use yii\db\Migration;

/**
 * Class m240605_033243_create_table_ts_phieu_bao_tri
 */
class m240605_033243_create_table_ts_phieu_bao_tri extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_phieu_bao_tri', [
            'id' => $this->primaryKey(),
            'id_ke_hoach' => $this->integer(),
            'ky_thu' => $this->integer(),
            'id_don_vi_bao_tri' => $this->integer(),
            'id_nguoi_chiu_trach_nhiem' => $this->integer(),
            'thoi_gian_bat_dau' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'thoi_gian_ket_thuc' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'noi_dung_thuc_hien' => $this->text(),
            'da_hoan_thanh' => $this->boolean(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
        // Tạo khóa ngoại liên kết với bảng ts_ke_hoach_bao_tri
        $this->addForeignKey(
            'fk-ts_phieu_bao_tri-id_ke_hoach',
            'ts_phieu_bao_tri',
            'id_ke_hoach',
            'ts_ke_hoach_bao_tri',
            'id',
            'CASCADE'
            );
    }
    
    //ALTER TABLE `ts_ke_hoach_bao_tri` CHANGE `ngay_bao_tri_cuoi` `ngay_bat_dau` DATE NULL DEFAULT NULL;

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       // echo "m240605_033243_create_table_ts_phieu_bao_tri cannot be reverted.\n";

        //return false;
        // Xóa khóa ngoại trước khi xóa bảng
        $this->dropForeignKey(
            'fk-ts_phieu_bao_tri-id_ke_hoach',
            'ts_phieu_bao_tri'
        );
        $this->dropTable('ts_phieu_bao_tri');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240605_033243_create_table_ts_phieu_bao_tri cannot be reverted.\n";

        return false;
    }
    */
}
