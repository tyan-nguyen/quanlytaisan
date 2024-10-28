<?php

use yii\db\Migration;

/**
 * Class m241028_000000_ins_field_
 */
class m241028_000000_add_column_id_ts_vt_to_phieu_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_sua_chua_vat_tu','id_tb_vt','INT(11) NULL');
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_sua_chua_vat_tu','id_tb_vt');
    }
    
    /*
     // Use up()/down() to run migration code without a transaction.
     public function up()
     {
     
     }
     
     public function down()
     {
     echo "m240823_023001_ins_field_ cannot be reverted.\n";
     
     return false;
     }
     */
}
