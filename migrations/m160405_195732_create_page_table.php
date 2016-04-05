<?php

use yii\db\Migration;

class m160405_195732_create_page_table extends Migration
{
    public function up()
    {
        $this->createTable('page_table', [
            'id' => $this->primaryKey()
        ]);
    }

    public function down()
    {
        $this->dropTable('page_table');
    }
}
