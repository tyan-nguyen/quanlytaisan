<?php

use yii\db\Migration;

/**
 * Class m240425_131223_create_table_ts_hinh_anh
 */
class m240425_131223_create_table_ts_hinh_anh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_hinh_anh', [
            'id' => $this->primaryKey(),
            'loai' => $this->string()->notNull(),
            'id_tham_chieu' => $this->integer()->notNull(),
            'ten_hien_thi' => $this->string(),
            'duong_dan' => $this->string(),
            'ten_file_luu' => $this->string(),
            'img_extension' => $this->string(),
            'img_size' => $this->integer(),
            'img_wh' => $this->string(),
            'ghi_chu' => $this->text(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_hinh_anh');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240425_131223_create_table_ts_hinh_anh cannot be reverted.\n";

        return false;
    }
    */
}
