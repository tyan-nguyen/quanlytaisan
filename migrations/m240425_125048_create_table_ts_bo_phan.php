<?php

use yii\db\Migration;

/**
 * Class m240425_125048_create_table_ts_bo_phan
 */
class m240425_125048_create_table_ts_bo_phan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_bo_phan', [
            'id' => $this->primaryKey(),
            'ma_bo_phan' => $this->string(20)->notNull(),
            'ten_bo_phan' => $this->string()->notNull(),
            'truc_thuoc' => $this->integer(),
            'la_dv_quan_ly' => $this->boolean(),
            'la_dv_su_dung' => $this->boolean(),
            'la_dv_bao_tri' => $this->boolean(),
            'la_dv_van_tai' => $this->boolean(),
            'la_dv_mua_hang' => $this->boolean(),
            'la_dv_quan_ly_kho' => $this->boolean(),
            'la_trung_tam_chi_phi' => $this->boolean(),
            'id_kho_vat_tu' => $this->integer(),
            'id_kho_phe_lieu' => $this->integer(),
            'id_kho_thanh_pham' => $this->integer(),
            'thoi_gian_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_tao' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_bo_phan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240425_125048_create_table_ts_bo_phan cannot be reverted.\n";

        return false;
    }
    */
}
