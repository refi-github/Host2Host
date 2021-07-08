<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partner_financial_performance}}`.
 */
class m201118_094736_create_partner_financial_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partner_financial_performance}}', [
            'id' => $this->primaryKey(),
            'financial_performance_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partner_financial_performance}}');
    }
}
