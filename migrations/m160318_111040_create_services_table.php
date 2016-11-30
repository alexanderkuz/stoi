<?php

use yii\db\Migration;

class m160318_111040_create_services_table extends Migration
{
    public function up()
    {
        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),//integer()->unsigned()
            'type' => 'enum("catalog", "item") NOT NULL DEFAULT "catalog"', //тип записи
            'parent_id'=>$this->integer()->unsigned()->notNull()->defaultValue(0),// Родительская запись
            'active' => 'enum("Yes", "No") NOT NULL DEFAULT "No"', //Актив
            'code'=>$this->string()->notNull()->unique(),// уникальный латинский код
            'name'=>$this->string()->notNull(),// имя сервиса(услуги)
            'sort'=>$this->integer()->unsigned()->notNull()->defaultValue(500),// Индекс сортировки.
            'created_date' => $this->dateTime()->notNull(),// дата создания
            'updated_date' => $this->dateTime()->notNull(),// дата изменния
            'picture'=>$this->string(),// Имя картинка
            'path_picture'=>$this->string(),// Путь до картинка

            'preview_text'=>$this->text(),// Предварительное описание
            'detail_text'=>$this->text(),// Детальное описание

            //'galleria_id'=>$this->integer()->unsigned(),// номер галереи для подсоединения

            'title'=>$this->string(),// title страницы
            'keywords'=>$this->string(),// meta-тег словосочетаний страницы
            'description'=>$this->string(),// meta-тег описание станицы

        ], $tableOptions);

        $this->createIndex('parent_id_type_sort','{{%services}}',['parent_id','type','sort']);
        $this->createIndex('parent_id','{{%services}}',['parent_id']);
        $this->createIndex('type','{{%services}}',['type']);
        $this->createIndex('sort','{{%services}}','sort');
    }

    public function down()
    {
        $this->dropTable('{{%services}}');
    }
}
