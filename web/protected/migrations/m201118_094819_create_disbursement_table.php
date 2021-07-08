<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%disbursement}}`.
 */
class m201118_094819_create_disbursement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%disbursement}}', [
            'id' => $this->primaryKey(),
            'partner_id' => $this->integer()->notNull(),
            'application_number' => $this->string()->notNull(),
            'contract_number' => $this->string()->notNull(),
            'disbursement_date' => $this->date()->notNull(),
            'amount' => $this->double()->notNull(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%disbursement}}');
    }
}
