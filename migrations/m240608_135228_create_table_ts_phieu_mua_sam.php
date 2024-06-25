<?php

use yii\db\Migration;

/**
 * Class m240608_135228_create_table_ts_phieu_mua_sam
 */
class m240608_135228_create_table_ts_phieu_mua_sam extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ts_phieu_mua_sam', [
            'id' => $this->primaryKey(),
            'ngay_yeu_cau' => $this->datetime(),
            'id_nguoi_duyet' => $this->integer(),
            'tong_phi' => $this->decimal(10, 2),
            'trang_thai' => $this->string()->defaultValue("draf"),
            'ghi_chu' => $this->text(),
            'nguoi_tao' => $this->integer(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'nguoi_cap_nhat' => $this->integer(),
            'ngay_cap_nhat' => $this->timestamp(),
        ]);

        // Tạo khóa ngoại liên kết với bảng user
        $this->addForeignKey(
            'fk-ts_phieu_mua_sam-id_nguoi_duyet',
            'ts_phieu_mua_sam',
            'id_nguoi_duyet',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Xóa khóa ngoại trước khi xóa bảng
        $this->dropForeignKey(
            'fk-ts_phieu_mua_sam-id_nguoi_duyet',
            'ts_phieu_mua_sam'
        );

        $this->dropTable('ts_phieu_mua_sam');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240608_135228_create_table_ts_phieu_mua_sam cannot be reverted.\n";

        return false;
    }
    */
}
