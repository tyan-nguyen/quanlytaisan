<?php

use yii\db\Migration;

/**
 * Class m240425_125859_create_table_ts_doi_tac
 */
class m240425_125859_create_table_ts_doi_tac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_doi_tac', [
            'id' => $this->primaryKey(),
            'ma_doi_tac' => $this->string(20)->notNull(),
            'ten_doi_tac' => $this->string()->notNull(),
            'id_nhom_doi_tac' => $this->integer()->notNull(),
            'dia_chi' => $this->string(),
            'dien_thoai' => $this->string(20),
            'email' => $this->string(),
            'tai_khoan_ngan_hang' => $this->string(100),
            'ma_so_thue' => $this->string(),
            'la_nha_cung_cap' => $this->boolean(),
            'la_khach_hang' => $this->boolean(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);

        // Tạo khóa ngoại liên kết với bảng ts_bo_phan
        $this->addForeignKey(
            'fk-ts_doi_tac-id_nhom_doi_tac',
            'ts_doi_tac',
            'id_nhom_doi_tac',
            'ts_nhom_doi_tac',
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
            'fk-ts_doi_tac-id_nhom_doi_tac',
            'ts_doi_tac'
        );

        $this->dropTable('ts_doi_tac');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240425_125859_create_table_ts_doi_tac cannot be reverted.\n";

        return false;
    }
    */
}
