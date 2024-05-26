<?php

use yii\db\Migration;

/**
 * Class m240426_081552_create_table_ts_vi_tri
 */
class m240426_081552_create_table_ts_vi_tri extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_vi_tri', [
            'id' => $this->primaryKey(),
            'ma_vi_tri' => $this->string()->notNull(),
            'ten_vi_tri' => $this->string()->notNull(),
            'mo_ta' => $this->text(),
            'truc_thuoc' => $this->integer(),
            'da_ngung_hoat_dong' => $this->boolean(),
            'ngay_ngung_hoat_dong' => $this->date(),
            'id_layout' => $this->integer(),
            'toa_do_x' => $this->double(),
            'toa_do_y' => $this->double(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_vi_tri');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_081552_create_table_ts_vi_tri cannot be reverted.\n";

        return false;
    }
    */
}
