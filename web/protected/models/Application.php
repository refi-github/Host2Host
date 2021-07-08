<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $partner_id
 * @property string $debtor_number
 * @property string $application_number
 * @property string $loan_date
 * @property string|null $start_date
 * @property string|null $due_date
 * @property float|null $product_service_amount
 * @property float|null $down_payment
 * @property float|null $admin_provision_fee
 * @property float|null $service_fee
 * @property float|null $initial_loan_principal
 * @property int|null $loan_term
 * @property string|null $period_type
 * @property float|null $margin_amount
 * @property float|null $loan_amount
 * @property float|null $installment_amount
 * @property string|null $first_installment_date
 * @property int|null $status
 * @property string|null $created_at
 */
class Application extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_PAID = 4;
    const STATUS_TERMINATED = 5;
    
    const PAGE_SIZE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'debtor_number', 'application_number', 'loan_date'], 'required'],
            [['partner_id', 'loan_term', 'status'], 'integer'],
            [['loan_date', 'start_date', 'due_date', 'first_installment_date', 'created_at'], 'safe'],
            [['product_service_amount', 'down_payment', 'admin_provision_fee', 'service_fee', 'initial_loan_principal', 'margin_amount', 'loan_amount', 'installment_amount'], 'number'],
            [['debtor_number', 'application_number', 'period_type'], 'string', 'max' => 255],
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
            'application_number' => 'Application Number',
            'loan_date' => 'Loan Date',
            'start_date' => 'Start Date',
            'due_date' => 'Due Date',
            'product_service_amount' => 'Product Service Amount',
            'down_payment' => 'Down Payment',
            'admin_provision_fee' => 'Admin Provision Fee',
            'service_fee' => 'Service Fee',
            'initial_loan_principal' => 'Initial Loan Principal',
            'loan_term' => 'Loan Term',
            'period_type' => 'Period Type',
            'margin_amount' => 'Margin Amount',
            'loan_amount' => 'Loan Amount',
            'installment_amount' => 'Installment Amount',
            'first_installment_date' => 'First Installment Date',
            'status' => 'Status',
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
                self::tableName() . '.application_number',
                self::tableName() . '.loan_date',
                self::tableName() . '.loan_term',
                self::tableName() . '.period_type',
                self::tableName() . '.product_service_amount',
                self::tableName() . '.installment_amount',
                self::tableName() . '.status',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
                Debtor::tableName() . '.name AS debtor',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . self::tableName() . '.debtor_number');

        if (Yii::$app->user->identity->role == User::ROLE_PARTNER) {
            $query->andFilterWhere(['=', self::tableName() . '.partner_id', Yii::$app->user->identity->partner_id]);   
        }

        if (isset($params['partner_id']) && $params['partner_id'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.partner_id', $params['partner_id']]);   
        }

        if (isset($params['debtor_name']) && $params['debtor_name'] != null) {
            $query->andFilterWhere(['like', Debtor::tableName() . '.name', $params['debtor_name']]);   
        }

        if (isset($params['application_number']) && $params['application_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.application_number', $params['application_number']]);   
        }

        if (isset($params['loan_date_from']) && isset($params['loan_date_until']) && $params['loan_date_from'] != null && $params['loan_date_until'] != null) {
            $query->andFilterWhere(['>=', self::tableName() . '.loan_date', $params['loan_date_from']])
                ->andFilterWhere(['<=', self::tableName() . '.loan_date', $params['loan_date_until']]);
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

        if (isset($params['application_number']) && $params['application_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.application_number', $params['application_number']]);   
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
                self::tableName() . '.application_number',
                self::tableName() . '.loan_date',
                self::tableName() . '.start_date',
                self::tableName() . '.due_date',
                self::tableName() . '.product_service_amount',
                self::tableName() . '.down_payment',
                self::tableName() . '.admin_provision_fee',
                self::tableName() . '.service_fee',
                self::tableName() . '.initial_loan_principal',
                self::tableName() . '.loan_term',
                self::tableName() . '.period_type',
                self::tableName() . '.margin_amount',
                self::tableName() . '.loan_amount',
                self::tableName() . '.installment_amount',
                self::tableName() . '.first_installment_date',
                self::tableName() . '.status',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
                Debtor::tableName() . '.name AS debtor',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . self::tableName() . '.debtor_number')
            ->where([self::tableName() . '.id' => $id]);

        return $query->one();
    }

    public static function getStatuses($status = null)
    {
        $results = [
            self::STATUS_PENDING => 'PENDING',
            self::STATUS_APPROVED => 'APPROVED',
            self::STATUS_REJECTED => 'REJECTED',
            self::STATUS_PAID => 'PAID',
            self::STATUS_TERMINATED => 'TERMINATED',
        ];

        if ($status != null) {
            return $results[$status];
        }

        return $results;
    }
}
