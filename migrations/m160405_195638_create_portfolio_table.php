<?php

use yii\db\Migration;

class m160405_195638_create_portfolio_table extends Migration
{
    public function up()
    {
        $this->createTable('portfolio_table', [
            'id' => $this->primaryKey()
        ]);
    }

    public function down()
    {
        $this->dropTable('portfolio_table');
    }
}
