<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aging".
 *
 * @property int $id
 * @property int $partner_id
 * @property string $application_number
 * @property float|null $installment_amount
 * @property int|null $installment_state_at
 * @property string|null $due_date
 * @property float|null $outstanding_principal_amount
 * @property float|null $outstanding_income_amount
 * @property float|null $outstanding_receivable_amount
 * @property float|null $not_yet_due_amount
 * @property float|null $overdue_1_10_amount
 * @property float|null $overdue_11_30_amount
 * @property float|null $overdue_31_60_amount
 * @property float|null $overdue_61_90_amount
 * @property float|null $overdue_over_90_amount
 * @property float|null $total_overdue_amount
 * @property float|null $previous_fine_amount
 * @property float|null $new_fine_amount
 * @property int|null $overdue_day_total
 * @property string|null $last_payment_date
 * @property string|null $created_at
 */
class Aging extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aging';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'application_number'], 'required'],
            [['partner_id', 'installment_state_at', 'overdue_day_total'], 'integer'],
            [['installment_amount', 'outstanding_principal_amount', 'outstanding_income_amount', 'outstanding_receivable_amount', 'not_yet_due_amount', 'overdue_1_10_amount', 'overdue_11_30_amount', 'overdue_31_60_amount', 'overdue_61_90_amount', 'overdue_over_90_amount', 'total_overdue_amount', 'previous_fine_amount', 'new_fine_amount'], 'number'],
            [['due_date', 'last_payment_date', 'created_at'], 'safe'],
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
            'installment_amount' => 'Installment Amount',
            'installment_state_at' => 'Installment State At',
            'due_date' => 'Due Date',
            'outstanding_principal_amount' => 'Outstanding Principal Amount',
            'outstanding_income_amount' => 'Outstanding Income Amount',
            'outstanding_receivable_amount' => 'Outstanding Receivable Amount',
            'not_yet_due_amount' => 'Not Yet Due Amount',
            'overdue_1_10_amount' => 'Overdue 1 10 Amount',
            'overdue_11_30_amount' => 'Overdue 11 30 Amount',
            'overdue_31_60_amount' => 'Overdue 31 60 Amount',
            'overdue_61_90_amount' => 'Overdue 61 90 Amount',
            'overdue_over_90_amount' => 'Overdue Over 90 Amount',
            'total_overdue_amount' => 'Total Overdue Amount',
            'previous_fine_amount' => 'Previous Fine Amount',
            'new_fine_amount' => 'New Fine Amount',
            'overdue_day_total' => 'Overdue Day Total',
            'last_payment_date' => 'Last Payment Date',
            'created_at' => 'Created At',
        ];
    }
}
