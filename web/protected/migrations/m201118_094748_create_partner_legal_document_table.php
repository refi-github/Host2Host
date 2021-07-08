<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partner_legal_document}}`.
 */
class m201118_094748_create_partner_legal_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partner_legal_document}}', [
            'id' => $this->primaryKey(),
            'legal_document_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partner_legal_document}}');
    }
}
