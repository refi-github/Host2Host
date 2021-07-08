<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "debtor".
 *
 * @property int $id
 * @property int $partner_id
 * @property string $debtor_number
 * @property string $name
 * @property string $id_card_number
 * @property string|null $birth_place
 * @property string|null $birth_date
 * @property string|null $gender
 * @property string|null $mother_name
 * @property string|null $tax_number
 * @property string|null $phone_number
 * @property string|null $cellphone_number
 * @property string|null $email
 * @property string|null $address
 * @property string|null $sub_district
 * @property string|null $district
 * @property string|null $city
 * @property string|null $province
 * @property string|null $zip_code
 * @property string|null $religion
 * @property string|null $education
 * @property string|null $profession
 * @property string|null $company_name
 * @property string|null $business_field
 * @property string|null $position
 * @property string|null $company_phone
 * @property string|null $company_email
 * @property string|null $company_address
 * @property string|null $company_sub_district
 * @property string|null $company_district
 * @property string|null $company_city
 * @property string|null $company_province
 * @property string|null $company_zip_code
 * @property float|null $monthly_income
 * @property string|null $marital_status
 * @property int|null $dependents_total
 * @property string|null $family_card_number
 * @property string|null $spouse_name
 * @property string|null $spouse_id_card_number
 * @property string|null $spouse_profession
 * @property string|null $spouse_monthly_income
 * @property string|null $created_at
 */
class Debtor extends \yii\db\ActiveRecord
{
    const PAGE_SIZE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debtor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'debtor_number', 'name', 'id_card_number'], 'required'],
            [['partner_id', 'dependents_total'], 'integer'],
            [['birth_date', 'created_at'], 'safe'],
            [['monthly_income'], 'number'],
            [['debtor_number', 'name', 'id_card_number', 'birth_place', 'gender', 'mother_name', 'tax_number', 'phone_number', 'cellphone_number', 'email', 'address', 'sub_district', 'district', 'city', 'province', 'zip_code', 'religion', 'education', 'profession', 'company_name', 'business_field', 'position', 'company_phone', 'company_email', 'company_address', 'company_sub_district', 'company_district', 'company_city', 'company_province', 'company_zip_code', 'marital_status', 'family_card_number', 'spouse_name', 'spouse_id_card_number', 'spouse_profession', 'spouse_monthly_income'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'Partner ID',
            'debtor_number' => 'Debtor Number',
            'name' => 'Name',
            'id_card_number' => 'Id Card Number',
            'birth_place' => 'Birth Place',
            'birth_date' => 'Birth Date',
            'gender' => 'Gender',
            'mother_name' => 'Mother Name',
            'tax_number' => 'Tax Number',
            'phone_number' => 'Phone Number',
            'cellphone_number' => 'Cellphone Number',
            'email' => 'Email',
            'address' => 'Address',
            'sub_district' => 'Sub District',
            'district' => 'District',
            'city' => 'City',
            'province' => 'Province',
            'zip_code' => 'Zip Code',
            'religion' => 'Religion',
            'education' => 'Education',
            'profession' => 'Profession',
            'company_name' => 'Company Name',
            'business_field' => 'Business Field',
            'position' => 'Position',
            'company_phone' => 'Company Phone',
            'company_email' => 'Company Email',
            'company_address' => 'Company Address',
            'company_sub_district' => 'Company Sub District',
            'company_district' => 'Company District',
            'company_city' => 'Company City',
            'company_province' => 'Company Province',
            'company_zip_code' => 'Company Zip Code',
            'monthly_income' => 'Monthly Income',
            'marital_status' => 'Marital Status',
            'dependents_total' => 'Dependents Total',
            'family_card_number' => 'Family Card Number',
            'spouse_name' => 'Spouse Name',
            'spouse_id_card_number' => 'Spouse Id Card Number',
            'spouse_profession' => 'Spouse Profession',
            'spouse_monthly_income' => 'Spouse Monthly Income',
            'created_at' => 'Created At',
        ];
    }

    public static function getAll($params = [])
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.debtor_number',
                self::tableName() . '.name',
                self::tableName() . '.id_card_number',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id');

        if (Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andFilterWhere(['=', self::tableName() . '.partner_id', Yii::$app->user->identity->partner_id]);   
        }

        if (isset($params['partner_id']) && $params['partner_id'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.partner_id', $params['partner_id']]);   
        }

        if (isset($params['debtor_number']) && $params['debtor_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.debtor_number', $params['debtor_number']]);   
        }

        if (isset($params['name']) && $params['name'] != null) {
            $query->andFilterWhere(['like', self::tableName() . '.name', $params['name']]);   
        }

        if (isset($params['id_card_number']) && $params['id_card_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.id_card_number', $params['id_card_number']]);   
        }

        if (isset($params['offset']) && $params['offset'] != null) {
            $query->offset($params['offset']);
        }

        if (isset($params['limit']) && $params['limit'] != null) {
            $query->limit($params['limit']);
        }

        $query->orderBy(['id' => SORT_DESC]);

        return $query->all();
    }

    public static function countAll($params = [])
    {
        $query = self::find();
        
        if (Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andFilterWhere(['=', self::tableName() . '.partner_id', Yii::$app->user->identity->partner_id]);   
        }

        if (isset($params['name']) && $params['name'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.name', $params['name']]);   
        }

        return $query->count();
    }

    public static function getById($id)
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.debtor_number',
                self::tableName() . '.name',
                self::tableName() . '.id_card_number',
                self::tableName() . '.birth_place',
                self::tableName() . '.birth_date',
                self::tableName() . '.gender',
                self::tableName() . '.mother_name',
                self::tableName() . '.tax_number',
                self::tableName() . '.phone_number',
                self::tableName() . '.cellphone_number',
                self::tableName() . '.email',
                self::tableName() . '.address',
                self::tableName() . '.sub_district',
                self::tableName() . '.district',
                self::tableName() . '.city',
                self::tableName() . '.province',
                self::tableName() . '.zip_code',
                self::tableName() . '.religion',
                self::tableName() . '.education',
                self::tableName() . '.profession',
                self::tableName() . '.company_name',
                self::tableName() . '.business_field',
                self::tableName() . '.position',
                self::tableName() . '.company_phone',
                self::tableName() . '.company_email',
                self::tableName() . '.company_address',
                self::tableName() . '.company_sub_district',
                self::tableName() . '.company_district',
                self::tableName() . '.company_city',
                self::tableName() . '.company_province',
                self::tableName() . '.company_zip_code',
                self::tableName() . '.monthly_income',
                self::tableName() . '.marital_status',
                self::tableName() . '.dependents_total',
                self::tableName() . '.family_card_number',
                self::tableName() . '.spouse_name',
                self::tableName() . '.spouse_id_card_number',
                self::tableName() . '.spouse_profession',
                self::tableName() . '.spouse_monthly_income',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->where([self::tableName() . '.id' => $id]);

        return $query->one();
    }
}
