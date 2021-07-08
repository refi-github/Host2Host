<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disbursement".
 *
 * @property int $id
 * @property int $partner_id
 * @property string $application_number
 * @property string $contract_number
 * @property string $disbursement_date
 * @property float $amount
 * @property string|null $created_at
 */
class Disbursement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disbursement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'application_number', 'contract_number', 'disbursement_date', 'amount'], 'required'],
            [['partner_id'], 'integer'],
            [['disbursement_date', 'created_at'], 'safe'],
            [['amount'], 'number'],
            [['application_number', 'contract_number'], 'string', 'max' => 255],
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
            'contract_number' => 'Contract Number',
            'disbursement_date' => 'Disbursement Date',
            'amount' => 'Amount',
            'created_at' => 'Created At',
        ];
    }

    public static function checkIfExists($partnerId, $contractNumber)
    {
        $model = self::findOne([
            'partner_id' => $partnerId,
            'contract_number' => $contractNumber,
        ]);
        
        return ($model != null); 
    }
}
