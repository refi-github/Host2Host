<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%debtor}}`.
 */
class m201118_094759_create_debtor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%debtor}}', [
            'id' => $this->primaryKey(),
            'partner_id' => $this->integer()->notNull(),
            'debtor_number' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'id_card_number' => $this->string()->notNull(),
            'birth_place' => $this->string(),
            'birth_date' => $this->date(),
            'gender' => $this->string(),
            'mother_name' => $this->string(),
            'tax_number' => $this->string(),
            'phone_number' => $this->string(),
            'cellphone_number' => $this->string(),
            'email' => $this->string(),
            'address' => $this->string(),
            'sub_district' => $this->string(),
            'district' => $this->string(),
            'city' => $this->string(),
            'province' => $this->string(),
            'zip_code' => $this->string(),
            'religion' => $this->string(),
            'education' => $this->string(),
            'profession' => $this->string(),
            'company_name' => $this->string(),
            'business_field' => $this->string(),
            'position' => $this->string(),
            'company_phone' => $this->string(),
            'company_email' => $this->string(),
            'company_address' => $this->string(),
            'company_sub_district' => $this->string(),
            'company_district' => $this->string(),
            'company_city' => $this->string(),
            'company_province' => $this->string(),
            'company_zip_code' => $this->string(),
            'monthly_income' => $this->double(),
            'marital_status' => $this->string(),
            'dependents_total' => $this->integer(),
            'family_card_number' => $this->string(),
            'spouse_name' => $this->string(),
            'spouse_id_card_number' => $this->string(),
            'spouse_profession' => $this->string(),
            'spouse_monthly_income' => $this->double(),
            'created_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%debtor}}');
    }
}
