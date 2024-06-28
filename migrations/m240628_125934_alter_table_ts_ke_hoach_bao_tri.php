<?php

use yii\db\Migration;

/**
 * Class m240507_125934_create_table_ts_ke_hoach_bao_tri
 */
class m240628_125934_alter_table_ts_ke_hoach_bao_tri extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('ts_ke_hoach_bao_tri','tan_suat', 'integer AFTER `ky_bao_tri`');
    }
    
    public function down()
    {
        $this->dropColumn('ts_ke_hoach_bao_tri', 'tan_suat');
    }
    
}
