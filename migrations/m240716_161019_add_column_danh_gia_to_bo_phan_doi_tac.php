<?php

use yii\db\Migration;

/**
 * Class m240716_161019_add_column_danh_gia_to_bo_phan_doi_tac
 */
class m240716_161019_add_column_danh_gia_to_bo_phan_doi_tac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_bo_phan', 'danh_gia', $this->integer()->defaultValue(0));
        $this->addColumn('ts_doi_tac', 'danh_gia', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_bo_phan', 'danh_gia');
        $this->dropColumn('ts_doi_tac', 'danh_gia');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240716_161019_add_column_danh_gia_to_bo_phan_doi_tac cannot be reverted.\n";

        return false;
    }
    */
}
