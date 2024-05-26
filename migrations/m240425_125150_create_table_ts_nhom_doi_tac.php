<?php

use yii\db\Migration;

/**
 * Class m240425_125150_create_table_ts_nhom_doi_tac
 */
class m240425_125150_create_table_ts_nhom_doi_tac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_nhom_doi_tac', [
            'id' => $this->primaryKey(),
            'ma_nhom' => $this->string()->notNull(),
            'ten_nhom' => $this->string()->notNull(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_nhom_doi_tac');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240426_073524_create_table_ts_nhom_doi_tac cannot be reverted.\n";

        return false;
    }
    */
}
