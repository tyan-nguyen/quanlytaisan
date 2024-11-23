<?php

use yii\db\Migration;

/**
 * Class m241121_000000_..
 */
class m241121_000000_add_4_column_duyet_vt_kho_to_ts_phieu_sua_chua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ts_phieu_sua_chua','duyet_vt_kho',$this->string(20)->null());
        $this->addColumn('ts_phieu_sua_chua','ngay_duyet_vt_kho',$this->dateTime()->null());
        $this->addColumn('ts_phieu_sua_chua','nguoi_duyet_vt_kho',$this->integer()->null());
        $this->addColumn('ts_phieu_sua_chua','noi_dung_duyet_vt_kho',$this->text()->null());
        $this->addColumn('ts_phieu_sua_chua','da_xuat_vt_kho',$this->boolean()->null());
        $this->addColumn('ts_phieu_sua_chua','ngay_xuat_vt_kho',$this->dateTime()->null());
        $this->addColumn('ts_phieu_sua_chua','nguoi_xuat_vt_kho',$this->integer()->null());
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ts_phieu_sua_chua','duyet_vt_kho');
        $this->dropColumn('ts_phieu_sua_chua','ngay_duyet_vt_kho');
        $this->dropColumn('ts_phieu_sua_chua','nguoi_duyet_vt_kho');
        $this->dropColumn('ts_phieu_sua_chua','noi_dung_duyet_vt_kho');
        $this->dropColumn('ts_phieu_sua_chua','da_xuat_vt_kho');
        $this->dropColumn('ts_phieu_sua_chua','ngay_xuat_vt_kho');
        $this->dropColumn('ts_phieu_sua_chua','nguoi_xuat_vt_kho');
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
