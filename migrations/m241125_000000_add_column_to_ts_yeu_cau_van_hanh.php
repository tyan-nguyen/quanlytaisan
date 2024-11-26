<?php

use yii\db\Migration;

/**
 * Class m241125_000000_..
 */
class m241125_000000_add_column_to_ts_yeu_cau_van_hanh extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //loai_phieu: phieu moi hay phieu chuyen
        //sét mặc định trong tạo phiếu là phieu_moi
        $this->addColumn('ts_yeu_cau_van_hanh','loai_phieu',$this->string(20)->null());
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_yeu_cau_van_hanh','loai_phieu');
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
