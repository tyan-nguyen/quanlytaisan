<?php

use yii\db\Migration;

/**
 * Class m240507_131512_create_table_ts_nhan_vien_kho
 */
class m240507_131512_create_table_ts_nhan_vien_kho extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_nhan_vien_kho', [
            'id' => $this->primaryKey(),
            'id_kho' => $this->integer()->notNull(),
            'id_nhan_vien' => $this->integer()->notNull(),
            'ngay_bat_dau' => $this->date(),
            'ngay_ket_thuc' => $this->date(),
            'la_quan_ly_kho' => $this->boolean(),
            'ghi_chu' => $this->text(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_kho_luu_tru
        $this->addForeignKey(
            'fk-ts_nhan_vien_kho-id_kho',
            'ts_nhan_vien_kho',
            'id_kho',
            'ts_kho_luu_tru',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_nhan_vien
        $this->addForeignKey(
            'fk-ts_nhan_vien_kho-id_nhan_vien',
            'ts_nhan_vien_kho',
            'id_nhan_vien',
            'ts_nhan_vien',
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
            'fk-ts_nhan_vien_kho-id_kho',
            'ts_nhan_vien_kho'
        );

        $this->dropForeignKey(
            'fk-ts_nhan_vien_kho-id_nhan_vien',
            'ts_nhan_vien_kho'
        );

        $this->dropTable('ts_nhan_vien_kho');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_131512_create_table_ts_nhan_vien_kho cannot be reverted.\n";

        return false;
    }
    */
}
