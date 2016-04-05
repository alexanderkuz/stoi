<?php

use yii\db\Migration;

class m160405_195804_create_fag_table extends Migration
{
    public function up()
    {
        $this->createTable('fag_table', [
            'id' => $this->primaryKey()
        ]);
    }

    public function down()
    {
        $this->dropTable('fag_table');
    }
}
