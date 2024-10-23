<?php

use yii\db\Migration;

/**
 * Class m241022_000000_ins_field_
 */
class m241022_000000_add_column_id_kho_to_thiet_bi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_thiet_bi','id_kho','INT(11) NULL');
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_thiet_bi','id_kho');
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
