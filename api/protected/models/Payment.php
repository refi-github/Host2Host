<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $partner_id
 * @property string $application_number
 * @property string $payment_date
 * @property string|null $due_date
 * @property int|null $installment_state_at
 * @property float|null $principal_amount
 * @property float|null $margin_amount
 * @property float|null $margin_discount
 * @property float|null $total_amount
 * @property string|null $created_at
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'application_number', 'payment_date'], 'required'],
            [['partner_id', 'installment_state_at'], 'integer'],
            [['payment_date', 'due_date', 'created_at'], 'safe'],
            [['principal_amount', 'margin_amount', 'margin_discount', 'total_amount'], 'number'],
            [['application_number'], 'string', 'max' => 255],
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
            'application_number' => 'Application Number',
            'payment_date' => 'Payment Date',
            'due_date' => 'Due Date',
            'installment_state_at' => 'Installment State At',
            'principal_amount' => 'Principal Amount',
            'margin_amount' => 'Margin Amount',
            'margin_discount' => 'Margin Discount',
            'total_amount' => 'Total Amount',
            'created_at' => 'Created At',
        ];
    }
}
