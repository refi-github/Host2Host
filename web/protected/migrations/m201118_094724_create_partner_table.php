<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partner}}`.
 */
class m201118_094724_create_partner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%partner}}', [
            'id' => $this->primaryKey(),
            'secret_key' => $this->string()->notNull(),
            'prefix' => $this->string()->notNull(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'financing_type' => $this->string(),
            'financing_scheme' => $this->string(),
            'margin_percentage' => $this->double(),
            'addm_addb' => $this->string(),
            'identity_number' => $this->string(),
            'establishment_number' => $this->string(),
            'establishment_place' => $this->string(),
            'establishment_date' => $this->date(),
            'last_change_number' => $this->string(),
            'last_change_date' => $this->date(),
            'phone_number' => $this->string(),
            'cellphone_number' => $this->string(),
            'email' => $this->string(),
            'address' => $this->string(),
            'sub_district' => $this->string(),
            'district' => $this->string(),
            'city' => $this->string(),
            'province' => $this->string(),
            'zip_code' => $this->string(),
            'country_code' => $this->string(),
            'business_field_code' => $this->string(),
            'reporter_relationship_code' => $this->string(),
            'go_public' => $this->integer(),
            'debtor_class_code' => $this->string(),
            'debtor_rating' => $this->string(),
            'rating_agency' => $this->string(),
            'rating_date' => $this->string(),
            'debtor_business_group' => $this->string(),
            'branch_office_code' => $this->string(),
            'fund_management_amount' => $this->double(),
            'interest_type' => $this->string(),
            'due_date' => $this->date(),
            'start_date' => $this->date(),
            'end_date' => $this->date(),
            'establishment_date_according_to_ahu' => $this->date(),
            'business_scope_id' => $this->integer(),
            'registered_on_ojk' => $this->integer(),
            'percentage_share_ownership' => $this->double(),
            'well_known_company' => $this->integer(),
            'financial_performance_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%partner}}');
    }
}
