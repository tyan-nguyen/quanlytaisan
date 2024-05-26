<?php

use yii\db\Migration;

/**
 * Class m240507_125221_create_table_ts_kho_luu_tru
 */
class m240507_125221_create_table_ts_kho_luu_tru extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_kho_luu_tru', [
            'id' => $this->primaryKey(),
            'ma_kho' => $this->string()->notNull(),
            'ten_kho' => $this->string()->notNull(),
            'loai_kho' => $this->string(),
            'id_nguoi_quan_ly' => $this->integer(),
            'id_bo_phan_quan_ly' => $this->integer(),
            'gia_tri_toi_da' => $this->decimal(10, 2),
            'dien_thoai' => $this->string(),
            'email' => $this->string(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_nhan_vien
        $this->addForeignKey(
            'fk-ts_kho_luu_tru-id_nguoi_quan_ly',
            'ts_kho_luu_tru',
            'id_nguoi_quan_ly',
            'ts_nhan_vien',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại liên kết với bảng ts_bo_phan
        $this->addForeignKey(
            'fk-ts_kho_luu_tru-id_bo_phan_quan_ly',
            'ts_kho_luu_tru',
            'id_bo_phan_quan_ly',
            'ts_bo_phan',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-ts_kho_luu_tru-id_nguoi_quan_ly',
            'ts_kho_luu_tru'
        );

        $this->dropForeignKey(
            'fk-ts_kho_luu_tru-id_bo_phan_quan_ly',
            'ts_kho_luu_tru'
        );

        $this->dropTable('ts_kho_luu_tru');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_125221_create_table_ts_kho_luu_tru cannot be reverted.\n";

        return false;
    }
    */
}
