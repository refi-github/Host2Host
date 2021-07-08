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
    const PAGE_SIZE = 10;

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

    public static function getAll($params = [])
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.application_number',
                self::tableName() . '.payment_date',
                self::tableName() . '.due_date',
                self::tableName() . '.installment_state_at',
                self::tableName() . '.principal_amount',
                self::tableName() . '.margin_amount',
                self::tableName() . '.margin_discount',
                self::tableName() . '.total_amount',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
                Debtor::tableName() . '.name AS debtor',
                Disbursement::tableName() . '.contract_number',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->leftJoin(Application::tableName(), Application::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Disbursement::tableName(), Disbursement::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . Application::tableName() . '.debtor_number');

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

        if (isset($params['contract_number']) && $params['contract_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.contract_number', $params['contract_number']]);   
        }

        if (isset($params['payment_date_from']) && isset($params['payment_date_until']) && $params['payment_date_from'] != null && $params['payment_date_until'] != null) {
            $query->andFilterWhere(['>=', self::tableName() . '.payment_date', $params['payment_date_from']])
                ->andFilterWhere(['<=', self::tableName() . '.payment_date', $params['payment_date_until']]);
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
        $query = self::find()
            ->leftJoin(Application::tableName(), Application::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . Application::tableName() . '.debtor_number');
        
        if (isset($params['partner_id']) && $params['partner_id'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.partner_id', $params['partner_id']]);   
        }

        if (isset($params['debtor_name']) && $params['debtor_name'] != null) {
            $query->andFilterWhere(['like', Debtor::tableName() . '.name', $params['debtor_name']]);   
        }

        if (isset($params['application_number']) && $params['application_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.application_number', $params['application_number']]);   
        }

        if (isset($params['contract_number']) && $params['contract_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.contract_number', $params['contract_number']]);   
        }

        if (isset($params['payment_date_from']) && isset($params['payment_date_until']) && $params['payment_date_from'] != null && $params['payment_date_until'] != null) {
            $query->andFilterWhere(['>=', self::tableName() . '.payment_date', $params['payment_date_from']])
                ->andFilterWhere(['<=', self::tableName() . '.payment_date', $params['payment_date_until']]);
        }

        if (isset($params['application_number']) && $params['application_number'] != null) {
            $query->andFilterWhere(['=', self::tableName() . '.application_number', $params['application_number']]);   
        }

        return $query->count();
    }

    public static function getReportPayment($params)
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.application_number',
                self::tableName() . '.payment_date',
                self::tableName() . '.due_date',
                self::tableName() . '.installment_state_at',
                self::tableName() . '.principal_amount',
                self::tableName() . '.margin_amount',
                self::tableName() . '.margin_discount',
                self::tableName() . '.total_amount',
                Partner::tableName() . '.name AS partner',
                Debtor::tableName() . '.name AS debtor',
                Disbursement::tableName() . '.contract_number',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->leftJoin(Application::tableName(), Application::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Disbursement::tableName(), Disbursement::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . Application::tableName() . '.debtor_number');
        $query->andFilterWhere(['=', self::tableName() . '.partner_id', $params['partner_id']]);   
        $query->andFilterWhere(['>=', self::tableName() . '.payment_date', $params['date_from']])
            ->andFilterWhere(['<=', self::tableName() . '.payment_date', $params['date_until']]);
        $query->orderBy(['id' => SORT_DESC]);
        $models = $query->all();
        
        $result = [];
        foreach ($models as $model) {
            $transactionAmount = $model['margin_amount'] + $model['margin_amount'];

            $result[] = [
                'flag' => 'D',
                'nama supplier' => $model['partner'],
                'no. kontrak internal' => $model['application_number'],
                'no. kontrak supplier' => $model['contract_number'],
                'nama debitur' => $model['debtor'],
                'due date' => $model['due_date'],
                'angsuran ke' => $model['installment_state_at'],
                'tanggal transaksi' => $model['payment_date'],
                'pokok' => $model['principal_amount'],
                'margin' => $model['margin_amount'],
                'nilai transaksi' => $transactionAmount,
                'diskon margin' => $model['margin_discount'],
                'total nilai transaksi' => $model['total_amount'],
            ];
        }

        return $result;
    }
}
