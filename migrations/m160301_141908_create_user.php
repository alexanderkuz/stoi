<?php

use yii\db\Schema;
use yii\db\Migration;



class m160301_141908_create_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'email_confirm_token' => $this->string(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'role' => 'enum("admin", "moderator", "user") NOT NULL DEFAULT "user"',
            // enum('Yes','No') NOT NULL DEFAULT 'Yes',
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            'username' => 'admin',
            'auth_key' =>  Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin123'),
            'email_confirm_token' => '',
            'password_reset_token' => '1',
            'email' => 'alexander@akuznecov.ru',
            'status' => 1,
            'role' => 'admin',
        ]);


        $this->insert('{{%user}}', [
            'id' => 2,
            'created_at' => time(),
            'updated_at' => time(),
            'username' => 'moderator',
            'auth_key' =>  Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin123'),
            'email_confirm_token' => '',
            'password_reset_token' => '2',
            'email' => 'design@kauma.ru',
            'status' => 1,
            'role' => 'moderator',
        ]);

        $this->insert('{{%user}}', [
            'id' => 3,
            'created_at' => time(),
            'updated_at' => time(),
            'username' => 'user',
            'auth_key' =>  Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin123'),
            'email_confirm_token' => '',
            'password_reset_token' => '3',
            'email' => 'hudwork@mail.ru',
            'status' => 1,
            'role' => 'user',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }

    /*

    'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
