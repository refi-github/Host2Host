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
 * @property float|null $first_installment_date
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

    public static function checkIfExists($partnerId, $applicationNumber)
    {
        $model = self::findOne([
            'partner_id' => $partnerId,
            'application_number' => $applicationNumber,
        ]);
        
        return ($model != null); 
    }
}
