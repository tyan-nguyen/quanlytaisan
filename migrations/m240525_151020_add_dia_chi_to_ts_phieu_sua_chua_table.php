<?php

use yii\db\Migration;

/**
 * Class m240525_151020_add_dia_chi_to_ts_phieu_sua_chua_table
 */
class m240525_151020_add_dia_chi_to_ts_phieu_sua_chua_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ts_phieu_sua_chua}}', 'dia_chi', $this->string()->after('trang_thai'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ts_phieu_sua_chua}}', 'dia_chi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240525_151020_add_dia_chi_to_ts_phieu_sua_chua_table cannot be reverted.\n";

        return false;
    }
    */
}
