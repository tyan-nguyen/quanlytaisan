<?php

use yii\db\Migration;

/**
 * Class m240717_144318_add_column_ghi_chu_duyet_to_ts_phieu_mua_sam
 */
class m240717_144318_add_column_ghi_chu_duyet_to_ts_phieu_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_mua_sam', 'ghi_chu_duyet', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_mua_sam', 'ghi_chu_duyet');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240717_144318_add_column_ghi_chu_duyet_to_ts_phieu_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
