<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ts_dm_dv_bao_gia}}`.
 */
class m240629_142900_create_ts_dm_dv_bao_gia_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_dm_dv_bao_gia', [
            'id' => $this->primaryKey(),
            'ten_don_vi' => $this->string()->notNull(),
            'dien_thoai1' => $this->string(),
            'dien_thoai2' => $this->string(),
            'dia_chi' => $this->text(),
            'nguoi_lien_he' => $this->string(),
            'danh_gia' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ts_dm_dv_bao_gia');
    }
}
