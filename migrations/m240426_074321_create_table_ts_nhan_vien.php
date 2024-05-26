<?php

use yii\db\Migration;

/**
 * Class m240426_074321_create_table_ts_nhan_vien
 */
class m240426_074321_create_table_ts_nhan_vien extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_nhan_vien', [
            'id' => $this->primaryKey(),
            'id_bo_phan' => $this->integer()->notNull(),
            'ma_nhan_vien' => $this->string()->notNull(),
            'ten_nhan_vien' => $this->string()->notNull(),
            'ngay_sinh' => $this->date(),
            'gioi_tinh' => $this->string(),
            'chuc_vu' => $this->string(),
            'ten_truy_cap' => $this->string(),
            'ngay_vao_lam' => $this->date(),
            'da_thoi_viec' => $this->boolean(),
            'ngay_thoi_viec' => $this->date(),
            'dien_thoai' => $this->string(),
            'email' => $this->string(),
            'dia_chi' => $this->text(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
        // Tạo khóa ngoại liên kết với bảng ts_bo_phan
        $this->addForeignKey(
            'fk-ts_nhan_vien-id_bo_phan',
            'ts_nhan_vien',
            'id_bo_phan',
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
            'fk-ts_nhan_vien-id_bo_phan',
            'ts_nhan_vien'
        );

        $this->dropTable('ts_nhan_vien');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_074321_create_table_ts_nhan_vien cannot be reverted.\n";

        return false;
    }
    */
}
