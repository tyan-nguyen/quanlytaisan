<?php

use yii\db\Migration;

/**
 * Class m240525_133847_add_hang_san_xuat_to_ts_vat_tu_table
 */
class m240525_133847_add_hang_san_xuat_to_ts_dm_vat_tu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ts_dm_vat_tu}}', 'hang_san_xuat', $this->string()->after('don_vi_tinh'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ts_vat_tu}}', 'hang_san_xuat');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240525_133847_add_hang_san_xuat_to_ts_vat_tu_table cannot be reverted.\n";

        return false;
    }
    */
}
