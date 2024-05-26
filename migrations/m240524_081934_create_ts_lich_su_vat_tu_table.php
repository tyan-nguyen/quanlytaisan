<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ts_lich_su_vat_tu}}`.
 */
class m240524_081934_create_ts_lich_su_vat_tu_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ts_lich_su_vat_tu}}', [
            'id' => $this->primaryKey(),
            'id_vat_tu' => $this->integer()->notNull(),
            'so_luong_cu' => $this->integer()->notNull(),
            'so_luong_moi' => $this->integer()->notNull(),
            'so_luong' => $this->integer()->notNull(),
            'ghi_chu' => $this->text(),
            'nguoi_tao' => $this->integer()->notNull(),
            'ngay_tao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        // Tạo khóa ngoại cho cột `id_vat_tu` với bảng `ts_dm_vat_tu`
        $this->addForeignKey(
            'fk-ts_lich_su_vat_tu-id_vat_tu',
            '{{%ts_lich_su_vat_tu}}',
            'id_vat_tu',
            '{{%ts_dm_vat_tu}}',
            'id',
            'CASCADE'
        );

        // Tạo khóa ngoại cho cột `nguoi_tao` với bảng `users`
        $this->addForeignKey(
            'fk-ts_lich_su_vat_tu-nguoi_tao',
            '{{%ts_lich_su_vat_tu}}',
            'nguoi_tao',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Hủy khóa ngoại và xóa bảng ts_lich_su_vat_tu
        $this->dropForeignKey(
            'fk-ts_lich_su_vat_tu-id_vat_tu',
            '{{%ts_lich_su_vat_tu}}'
        );

        $this->dropForeignKey(
            'fk-ts_lich_su_vat_tu-nguoi_tao',
            '{{%ts_lich_su_vat_tu}}'
        );

        $this->dropTable('{{%ts_lich_su_vat_tu}}');
    }
}
