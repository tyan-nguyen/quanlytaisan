<?php

use yii\db\Migration;

/**
 * Class m240823_023001_ins_field_
 */
class m241004_000000_add_column_id_phieu_mua_sam_to_thiet_bi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_thiet_bi','id_phieu_mua_sam','INT(11) NULL');
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_thiet_bi','id_phieu_mua_sam');
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
