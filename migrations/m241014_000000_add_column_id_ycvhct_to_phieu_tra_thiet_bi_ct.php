<?php

use yii\db\Migration;

/**
 * Class m241014_023001_ins_field_
 */
class m241014_000000_add_column_id_ycvhct_to_phieu_tra_thiet_bi_ct extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_tra_thiet_bi_ct','id_ycvhct','INT(11) NULL');
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_tra_thiet_bi_ct','id_ycvhct');
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
