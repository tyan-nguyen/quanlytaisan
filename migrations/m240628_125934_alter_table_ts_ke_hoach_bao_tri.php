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
        $this->addColumn('tan_suat', $this->integer(11));
    }
    
    public function down()
    {
        
    }
    
}