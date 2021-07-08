<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property string $secret_key
 * @property string $prefix
 * @property string $code
 * @property string $name
 * @property string|null $financing_type
 * @property string|null $financing_scheme
 * @property float|null $margin_percentage
 * @property string|null $addm_addb
 * @property string|null $identity_number
 * @property string|null $establishment_number
 * @property string|null $establishment_place
 * @property string|null $establishment_date
 * @property string|null $last_change_number
 * @property string|null $last_change_date
 * @property string|null $phone_number
 * @property string|null $cellphone_number
 * @property string|null $email
 * @property string|null $address
 * @property string|null $sub_district
 * @property string|null $district
 * @property string|null $city
 * @property string|null $province
 * @property string|null $zip_code
 * @property string|null $country_code
 * @property string|null $business_field_code
 * @property string|null $reporter_relationship_code
 * @property int|null $go_public
 * @property string|null $debtor_class_code
 * @property string|null $debtor_rating
 * @property string|null $rating_agency
 * @property string|null $rating_date
 * @property string|null $debtor_business_group
 * @property string|null $branch_office_code
 * @property float|null $fund_management_amount
 * @property string|null $interest_type
 * @property string|null $due_date
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $establishment_date_according_to_ahu
 * @property int|null $business_scope_id
 * @property int|null $registered_on_ojk
 * @property float|null $percentage_share_ownership
 * @property int|null $well_known_company
 * @property int|null $financial_performance_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $status
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['secret_key', 'prefix', 'code', 'name'], 'required'],
            [['margin_percentage', 'fund_management_amount', 'percentage_share_ownership'], 'number'],
            [['establishment_date', 'last_change_date', 'due_date', 'start_date', 'end_date', 'establishment_date_according_to_ahu', 'created_at', 'updated_at'], 'safe'],
            [['go_public', 'business_scope_id', 'registered_on_ojk', 'well_known_company', 'financial_performance_id', 'status'], 'integer'],
            [['secret_key', 'prefix', 'code', 'name', 'financing_type', 'financing_scheme', 'addm_addb', 'identity_number', 'establishment_number', 'establishment_place', 'last_change_number', 'phone_number', 'cellphone_number', 'email', 'address', 'sub_district', 'district', 'city', 'province', 'zip_code', 'country_code', 'business_field_code', 'reporter_relationship_code', 'debtor_class_code', 'debtor_rating', 'rating_agency', 'rating_date', 'debtor_business_group', 'branch_office_code', 'interest_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'secret_key' => 'Secret Key',
            'prefix' => 'Prefix',
            'code' => 'Code',
            'name' => 'Name',
            'financing_type' => 'Financing Type',
            'financing_scheme' => 'Financing Scheme',
            'margin_percentage' => 'Margin Percentage',
            'addm_addb' => 'Addm Addb',
            'identity_number' => 'Identity Number',
            'establishment_number' => 'Establishment Number',
            'establishment_place' => 'Establishment Place',
            'establishment_date' => 'Establishment Date',
            'last_change_number' => 'Last Change Number',
            'last_change_date' => 'Last Change Date',
            'phone_number' => 'Phone Number',
            'cellphone_number' => 'Cellphone Number',
            'email' => 'Email',
            'address' => 'Address',
            'sub_district' => 'Sub District',
            'district' => 'District',
            'city' => 'City',
            'province' => 'Province',
            'zip_code' => 'Zip Code',
            'country_code' => 'Country Code',
            'business_field_code' => 'Business Field Code',
            'reporter_relationship_code' => 'Reporter Relationship Code',
            'go_public' => 'Go Public',
            'debtor_class_code' => 'Debtor Class Code',
            'debtor_rating' => 'Debtor Rating',
            'rating_agency' => 'Rating Agency',
            'rating_date' => 'Rating Date',
            'debtor_business_group' => 'Debtor Business Group',
            'branch_office_code' => 'Branch Office Code',
            'fund_management_amount' => 'Fund Management Amount',
            'interest_type' => 'Interest Type',
            'due_date' => 'Due Date',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'establishment_date_according_to_ahu' => 'Establishment Date According To Ahu',
            'business_scope_id' => 'Business Scope ID',
            'registered_on_ojk' => 'Registered On Ojk',
            'percentage_share_ownership' => 'Percentage Share Ownership',
            'well_known_company' => 'Well Known Company',
            'financial_performance_id' => 'Financial Performance ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public static function getBySecretKey($secretKey)
    {
        return self::findOne(['secret_key' => $secretKey]);
    }
}
