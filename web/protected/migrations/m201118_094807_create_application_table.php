<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application}}`.
 */
class m201118_094807_create_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'partner_id' => $this->integer()->notNull(),
            'debtor_number' => $this->string()->notNull(),
            'application_number' => $this->string()->notNull(),
            'loan_date' => $this->date()->notNull(),
            'start_date' => $this->date(),
            'due_date' => $this->date(),
            'product_service_amount' => $this->double(),
            'down_payment' => $this->double(),
            'admin_provision_fee' => $this->double(),
            'service_fee' => $this->double(),
            'initial_loan_principal' => $this->double(),
            'loan_term' => $this->integer(),
            'period_type' => $this->string(),
            'margin_amount' => $this->double(),
            'loan_amount' => $this->double(),
            'installment_amount' => $this->double(),
            'first_installment_date' => $this->date(),
            'status' => $this->integer(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%application}}');
    }
}
