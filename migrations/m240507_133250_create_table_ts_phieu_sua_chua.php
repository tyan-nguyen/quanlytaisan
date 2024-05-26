<?php

use yii\db\Migration;

/**
 * Class m240507_133250_create_table_ts_phieu_sua_chua
 */
class m240507_133250_create_table_ts_phieu_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_phieu_sua_chua', [
            'id' => $this->primaryKey(),
            'id_thiet_bi' => $this->integer()->notNull(),
            'id_tt_sua_chua' => $this->integer()->notNull(),
            'ngay_sua_chua' => $this->datetime(),
            'ngay_du_kien_hoan_thanh' => $this->datetime(),
            'ngay_hoan_thanh' => $this->datetime(),
            'phi_linh_kien' => $this->decimal(10, 2),
            'phi_khac' => $this->decimal(10, 2),
            'tong_tien' => $this->decimal(10, 2),
            'trang_thai' => $this->string(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
            'nguoi_cap_nhat' => $this->integer(),
            'ghi_chu1' => $this->text(),
            'ghi_chu2' => $this->text(),
            'danh_gia_sc' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_thiet_bi
        $this->addForeignKey(
            'fk-ts_phieu_sua_chua-id_thiet_bi',
            'ts_phieu_sua_chua',
            'id_thiet_bi',
            'ts_thiet_bi',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_dm_tt_sua_chua
        $this->addForeignKey(
            'fk-ts_phieu_sua_chua-id_tt_sua_chua',
            'ts_phieu_sua_chua',
            'id_tt_sua_chua',
            'ts_dm_tt_sua_chua',
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
            'fk-ts_phieu_sua_chua-id_thiet_bi',
            'ts_phieu_sua_chua'
        );

        $this->dropForeignKey(
            'fk-ts_phieu_sua_chua-id_tt_sua_chua',
            'ts_phieu_sua_chua'
        );

        $this->dropTable('ts_phieu_sua_chua');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_133250_create_table_ts_phieu_sua_chua cannot be reverted.\n";

        return false;
    }
    */
}
