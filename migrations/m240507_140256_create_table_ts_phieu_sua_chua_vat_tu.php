<?php

use yii\db\Migration;

/**
 * Class m240507_140256_create_table_ts_phieu_sua_chua_vat_tu
 */
class m240507_140256_create_table_ts_phieu_sua_chua_vat_tu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_phieu_sua_chua_vat_tu', [
            'id' => $this->primaryKey(),
            'id_phieu_sua_chua' => $this->integer()->notNull(),
            'id_vat_tu' => $this->integer()->notNull(),
            'so_luong' => $this->integer(),
            'ghi_chu' => $this->text(),
            'don_vi_tinh' => $this->string(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
            'nguoi_cap_nhat' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_phieu_sua_chua
        $this->addForeignKey(
            'fk-ts_phieu_sua_chua_vat_tu-id_phieu_sua_chua',
            'ts_phieu_sua_chua_vat_tu',
            'id_phieu_sua_chua',
            'ts_phieu_sua_chua',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_dm_vat_tu
        $this->addForeignKey(
            'fk-ts_phieu_sua_chua_vat_tu-id_vat_tu',
            'ts_phieu_sua_chua_vat_tu',
            'id_vat_tu',
            'ts_dm_vat_tu',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240507_140256_create_table_ts_phieu_sua_chua_vat_tu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_140256_create_table_ts_phieu_sua_chua_vat_tu cannot be reverted.\n";

        return false;
    }
    */
}
