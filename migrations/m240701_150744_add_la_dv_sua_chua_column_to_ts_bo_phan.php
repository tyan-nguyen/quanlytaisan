<?php

use yii\db\Migration;

/**
 * Class m240701_150744_add_la_dv_sua_chua_column_to_ts_bo_phan
 */
class m240701_150744_add_la_dv_sua_chua_column_to_ts_bo_phan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_bo_phan', 'la_dv_sua_chua', $this->integer()->defaultValue(0)->after('la_trung_tam_chi_phi'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_bo_phan', 'la_dv_sua_chua');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240701_150744_add_la_dv_sua_chua_column_to_ts_bo_phan cannot be reverted.\n";

        return false;
    }
    */
}
