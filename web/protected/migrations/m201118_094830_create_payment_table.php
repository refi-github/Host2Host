<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment}}`.
 */
class m201118_094830_create_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'partner_id' => $this->integer()->notNull(),
            'application_number' => $this->string()->notNull(),
            'payment_date' => $this->date()->notNull(),
            'due_date' => $this->date(),
            'installment_state_at' => $this->integer(),
            'principal_amount' => $this->double(),
            'margin_amount' => $this->double(),
            'margin_discount' => $this->double(),
            'total_amount' => $this->double(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
    }
}
