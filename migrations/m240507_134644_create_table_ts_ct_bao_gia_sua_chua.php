<?php

use yii\db\Migration;

/**
 * Class m240507_134644_create_table_ts_ct_bao_gia_sua_chua
 */
class m240507_134644_create_table_ts_ct_bao_gia_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_ct_bao_gia_sua_chua', [
            'id' => $this->primaryKey(),
            'id_bao_gia' => $this->integer()->notNull(),
            'id_dm_bao_gia' => $this->integer(),
            'ten_danh_muc' => $this->string(),
            'so_luong' => $this->integer(),
            'don_vi_tinh' => $this->string(),
            'don_gia' => $this->decimal(10, 2),
            'thanh_tien' => $this->decimal(10, 2),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
            'nguoi_cap_nhat' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_bao_gia_sua_chua
        $this->addForeignKey(
            'fk-ts_ct_bao_gia_sua_chua-id_bao_gia',
            'ts_ct_bao_gia_sua_chua',
            'id_bao_gia',
            'ts_bao_gia_sua_chua',
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
            'fk-ts_ct_bao_gia_sua_chua-id_bao_gia',
            'ts_ct_bao_gia_sua_chua'
        );

        $this->dropTable('ts_ct_bao_gia_sua_chua');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_134644_create_table_ts_ct_bao_gia_sua_chua cannot be reverted.\n";

        return false;
    }
    */
}
