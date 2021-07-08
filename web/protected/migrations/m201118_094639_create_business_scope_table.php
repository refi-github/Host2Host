<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%business_scope}}`.
 */
class m201118_094639_create_business_scope_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%business_scope}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->batchInsert('business_scope', 
            [
                'id',
                'name',
            ], 
            [
                [
                    1,
                    'Lokal',
                ],
                [
                    2,
                    'Interlokal',
                ],
            ],
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%business_scope}}');
    }
}
