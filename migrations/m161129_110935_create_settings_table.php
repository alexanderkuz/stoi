<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class m161129_110935_create_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),// индекс
            'created_date' => $this->dateTime()->notNull(),// дата создания
            'updated_date' => $this->dateTime()->notNull(),// дата изменния
            'name'=>$this->string()->notNull(),// имя настроки
            'code'=>$this->string()->notNull()->unique(),// уникальный латинский код
            'sort'=>$this->integer()->unsigned()->notNull()->defaultValue(500),// Индекс сортировки.
            'type'=>'enum("text","int","float","array","picture") NOT NULL DEFAULT "text"', //тип значения value
            'model' => 'enum("common","user", "services","portfolio","page","fag") NOT NULL DEFAULT "common"', //тип настроки отношение к другим моделям(имя модели)
            'picture'=>$this->string(),// Имя картинка
            'path_picture'=>$this->string(),// Путь до картинка
            'value'=>$this->text(),//значение настройки
            'comment'=>$this->string(),// описание настройки(коментарий)
        ], $tableOptions);

        $this->createIndex('idx_model_code','{{%settings}}',['model','code']);// индекс

        $datatimes=date('Y-m-d H:i:s');

        $this->batchInsert('{{%settings}}',['created_date' ,'updated_date','name','code','value','comment'],
            [
                [
                    $datatimes,
                    $datatimes,
                    'Заголовок главной странице',
                    'title',
                    'Строительная компания ‘StroiYt’',
                    'Заголовок главной странице',
                ],
                [
                    $datatimes,
                    $datatimes,
                    'keywords',
                    'keywords',
                    'ремонт потолков, ремонт стен, проводка электрики, ремонт полов, установка сантехники, ремонт квартиры, ремонт комнаты, ремонт дома',
                    'keywords главной странице',
                ],
                [
                    $datatimes,
                    $datatimes,
                    'description',
                    'description',
                    'Строительная компания «СтройЮт" осуществляет строительные и ремонтно-отделочные работы в ближайшем Подмосковье и Москве. Мы предлагаем большой выбор строительных работ по внутренней отделке помещений.',
                    'description главной странице',
                ],
            ]
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%settings}}');
    }
}