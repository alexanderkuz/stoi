<?php

use yii\db\Migration;

class m160405_195638_create_portfolio_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%portfolio}}', [
            'id' => $this->primaryKey(),//integer()->unsigned()
            'created_date' => $this->dateTime()->notNull(),// дата создания
            'updated_date' => $this->dateTime()->notNull(),// дата изменния

            'type' => 'enum("catalog", "item") NOT NULL DEFAULT "catalog"', //тип записи раздел или элемент
            'parent_id'=>$this->integer()->unsigned()->notNull()->defaultValue(0),// Родительская запись
            'active' => 'enum("Yes", "No") NOT NULL DEFAULT "No"', //Актив

            'name'=>$this->string()->notNull(),// имя страницы(раздела)
            'code'=>$this->string()->notNull()->unique(),// уникальный латинский код
            'sort'=>$this->integer()->unsigned()->notNull()->defaultValue(500),// Индекс сортировки.

            'picture'=>$this->string(),// Имя картинка
            'path_picture'=>$this->string(),// Путь до картинка

            'preview_text'=>$this->text(),// Предварительное описание
            'detail_text'=>$this->text(),// Детальное описание

            //'galleria_id'=>$this->integer()->unsigned(),// номер галереи для подсоединения

            'title'=>$this->string(),// title страницы
            'keywords'=>$this->string(),// meta-тег словосочетаний страницы
            'description'=>$this->string(),// meta-тег описание станицы


        ], $tableOptions);

        $this->createIndex('parent_id_type_sort','{{%portfolio}}',['parent_id','type','sort']);
     //   $this->createIndex('parent_id','{{%portfolio}}',['parent_id']);
     //   $this->createIndex('type','{{%portfolio}}',['type']);
     //   $this->createIndex('sort','{{%portfolio}}','sort');

    }

    public function down()
    {
        $this->dropTable('{{%portfolio}}');
    }
}
