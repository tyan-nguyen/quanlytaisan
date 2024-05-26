<?php

use yii\db\Migration;

/**
 * Class m240507_135522_create_table_ts_dm_vat_tu
 */
class m240507_135522_create_table_ts_dm_vat_tu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_dm_vat_tu', [
            'id' => $this->primaryKey(),
            'ten_vat_tu' => $this->string()->notNull(),
            'so_luong' => $this->integer(),
            'id_kho' => $this->integer(),
            'don_vi_tinh' => $this->string(),
            'trang_thai' => $this->string(),
            'don_gia' => $this->decimal(10, 2),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_kho_luu_tru
        $this->addForeignKey(
            'fk-ts_dm_vat_tu-id_kho',
            'ts_dm_vat_tu',
            'id_kho',
            'ts_kho_luu_tru',
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
            'fk-ts_dm_vat_tu-id_kho',
            'ts_dm_vat_tu'
        );

        $this->dropTable('ts_dm_vat_tu');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_135522_create_table_ts_dm_vat_tu cannot be reverted.\n";

        return false;
    }
    */
}
