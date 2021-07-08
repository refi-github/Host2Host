<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aging}}`.
 */
class m201118_113423_create_aging_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aging}}', [
            'id' => $this->primaryKey(),
            'partner_id' => $this->integer()->notNull(),
            'application_number' => $this->string()->notNull(),
            'installment_amount' => $this->double(),
            'installment_state_at' => $this->integer(),
            'due_date' => $this->date(),
            'outstanding_principal_amount' => $this->double(),
            'outstanding_income_amount' => $this->double(),
            'outstanding_receivable_amount' => $this->double(),
            'not_yet_due_amount' => $this->double(),
            'overdue_1_10_amount' => $this->double(),
            'overdue_11_30_amount' => $this->double(),
            'overdue_31_60_amount' => $this->double(),
            'overdue_61_90_amount' => $this->double(),
            'overdue_over_90_amount' => $this->double(),
            'total_overdue_amount' => $this->double(),
            'previous_fine_amount' => $this->double(),
            'new_fine_amount' => $this->double(),
            'overdue_day_total' => $this->integer(),
            'last_payment_date' => $this->date(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%aging}}');
    }
}
