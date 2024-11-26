<?php

use yii\db\Migration;

/**
 * Class m241125_000001_..
 */
class m241125_000001_add_column_to_ts_yeu_cau_van_hanh_ct extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_yeu_cau_van_hanh_ct','id_ycvhct_chuyen',$this->integer(11)->null());
        $this->addColumn('ts_yeu_cau_van_hanh_ct','loai_van_hanh',$this->string(20)->null());
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_yeu_cau_van_hanh_ct','id_ycvhct_chuyen');
        $this->dropColumn('ts_yeu_cau_van_hanh_ct','loai_van_hanh');
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