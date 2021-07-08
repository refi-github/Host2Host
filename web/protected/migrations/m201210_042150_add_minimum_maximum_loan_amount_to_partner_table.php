<?php

use yii\db\Migration;

/**
 * Class m201210_042150_add_minimum_maximum_loan_amount_to_partner_table
 */
class m201210_042150_add_minimum_maximum_loan_amount_to_partner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('partner', 'minimum_loan_amount', $this->double()->after('financial_performance_id'));
        $this->addColumn('partner', 'maximum_loan_amount', $this->double()->after('minimum_loan_amount'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('partner', 'minimum_loan_amount');
        $this->dropColumn('partner', 'maximum_loan_amount');
    }
}
