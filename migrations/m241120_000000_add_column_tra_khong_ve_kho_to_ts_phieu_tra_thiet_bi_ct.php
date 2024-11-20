<?php

use yii\db\Migration;

/**
 * Class m241120_000000_..
 */
class m241120_000000_add_column_tra_khong_ve_kho_to_ts_phieu_tra_thiet_bi_ct extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_tra_thiet_bi_ct','tra_khong_ve_kho',$this->boolean()->null());
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_tra_thiet_bi_ct','tra_khong_ve_kho');
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
