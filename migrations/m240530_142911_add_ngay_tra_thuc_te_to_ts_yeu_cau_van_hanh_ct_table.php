<?php

use yii\db\Migration;

/**
 * Class m240530_142911_add_ngay_tra_thuc_te_to_ts_yeu_cau_van_hanh_ct_table
 */
class m240530_142911_add_ngay_tra_thuc_te_to_ts_yeu_cau_van_hanh_ct_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {   
        $this->addColumn('ts_yeu_cau_van_hanh_ct', 'ngay_tra_thuc_te', $this->dateTime()->null()->after('ngay_ket_thuc'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // echo "m240530_142911_add_ngay_tra_thuc_te_to_ts_yeu_cau_van_hanh_ct_table cannot be reverted.\n";
        // return false;
        $this->dropColumn('ts_yeu_cau_van_hanh_ct', 'ngay_tra_thuc_te');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240530_142911_add_ngay_tra_thuc_te_to_ts_yeu_cau_van_hanh_ct_table cannot be reverted.\n";

        return false;
    }
    */
}
