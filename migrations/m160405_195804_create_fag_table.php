<?php

use yii\db\Migration;

class m160405_195804_create_fag_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%fag}}', [
            'id' => $this->primaryKey(),//integer()->unsigned()
            'created_date' => $this->dateTime()->notNull(),// дата создания
            'updated_date' => $this->dateTime()->notNull(),// дата изменния

            'type' => 'enum("catalog", "item") NOT NULL DEFAULT "catalog"', //тип записи раздел или элемент
            'parent_id'=>$this->integer()->unsigned()->notNull()->defaultValue(0),// Родительская запись
            'active' => 'enum("Yes", "No","Waiting") NOT NULL DEFAULT "Waiting"', //Актив, не активное или ждущие ответа

            'name'=>$this->string()->notNull(),// имя вопроса(раздела)
            'code'=>$this->string()->notNull()->unique(),// уникальный латинский код
            'sort'=>$this->integer()->unsigned()->notNull()->defaultValue(500),// Индекс сортировки.

            'username'=>$this->string(),// имя пользователя
            'email' => $this->string(),//email пользователя(юзера)
            'url' => $this->string(),// адрес сайта


            'picture'=>$this->string(),// Имя картинка
            'path_picture'=>$this->string(),// Путь до картинка

            'preview_text'=>$this->text(),// Предварительное описание
            'detail_text'=>$this->text(),// Детальное описание

            //'galleria_id'=>$this->integer()->unsigned(),// номер галереи для подсоединения

            'title'=>$this->string(),// title страницы
            'keywords'=>$this->string(),// meta-тег словосочетаний страницы
            'description'=>$this->string(),// meta-тег описание станицы

        ], $tableOptions);

        $this->createIndex('parent_id_type_sort','{{%fag}}',['parent_id','type','sort']);
      //  $this->createIndex('parent_id','{{%fag}}',['parent_id']);
     //   $this->createIndex('type','{{%fag}}',['type']);
      //  $this->createIndex('sort','{{%fag}}','sort');

        $datatimes=date('Y-m-d H:i:s');

        $this->batchInsert('{{%fag}}',['created_date' ,'updated_date','type','name','code','preview_text', 'detail_text' ],
            [
                [
                    $datatimes,                   //'created_date'
                    $datatimes,                   //'updated_date'
                    'catalog',                    //'type'
                    'Общие вопросы',           //'name'
                    'main',                       //'code'
                    'Общие вопросы',           //'preview_text'
                    '<p>Общие вопросы</p>',    //'detail_text'
                ],
            ]
        );

    }

    public function down()
    {
        $this->dropTable('{{%fag}}');
    }
}
