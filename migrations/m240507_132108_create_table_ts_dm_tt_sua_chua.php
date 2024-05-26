<?php

use yii\db\Migration;

/**
 * Class m240507_132108_create_table_ts_dm_tt_sua_chua
 */
class m240507_132108_create_table_ts_dm_tt_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_dm_tt_sua_chua', [
            'id' => $this->primaryKey(),
            'ten_tt_sua_chua' => $this->string()->notNull(),
            'dien_thoai1' => $this->string(),
            'dien_thoai2' => $this->string(),
            'dia_chi' => $this->text(),
            'nguoi_lien_he' => $this->string(),
            'danh_gia' => $this->integer(),
            // Thêm các trường dữ liệu khác tại đây...
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_dm_tt_sua_chua');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240507_132108_create_table_ts_dm_tt_sua_chua cannot be reverted.\n";

        return false;
    }
    */
}
