<?php

use yii\db\Migration;

/**
 * Class m240608_143038_create_table_ts_phieu_nhap_hang
 */
class m240608_143038_create_table_ts_phieu_nhap_hang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_phieu_nhap_hang', [
            'id' => $this->primaryKey(),
            'so_phieu' => $this->string(),
            'ngay_nhap_hang' => $this->date(),
            'id_phieu_mua_sam' => $this->integer(),
            'trang_thai' => $this->string(),
            'ghi_chu' => $this->text(),
            'nguoi_tao' => $this->integer(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_cap_nhat' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_phieu_mua_sam
        $this->addForeignKey(
            'fk-ts_phieu_nhap_hang-id_phieu_mua_sam',
            'ts_phieu_nhap_hang',
            'id_phieu_mua_sam',
            'ts_phieu_mua_sam',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Xóa khóa ngoại trước khi xóa bảng
        $this->dropForeignKey(
            'fk-ts_phieu_nhap_hang-id_phieu_mua_sam',
            'ts_phieu_nhap_hang'
        );

        $this->dropTable('ts_phieu_nhap_hang');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240608_143038_create_table_ts_phieu_nhap_hang cannot be reverted.\n";

        return false;
    }
    */
}
