<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201118_091241_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'role' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'username' => $this->string(30)->notNull(),
            'password' => $this->string()->notNull(),
            'partner_id' => $this->integer(),
            'access_token' => $this->string(),
        ]);

        $this->insert('user', [
            'id' => 1,
            'role' => 1,
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => 'd033e22ae348aeb5660fc2140aec35850c4da997',
            'partner_id' => null,
            'access_token' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
