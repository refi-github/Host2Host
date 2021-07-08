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
    const PAGE_SIZE = 10;

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

    public static function getAll($params = [])
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.application_number',
                self::tableName() . '.installment_amount',
                self::tableName() . '.installment_state_at',
                self::tableName() . '.due_date',
                self::tableName() . '.total_overdue_amount',
                self::tableName() . '.overdue_day_total',
                self::tableName() . '.last_payment_date',
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

        return $query->count();
    }

    public static function getById($id)
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.application_number',
                self::tableName() . '.installment_amount',
                self::tableName() . '.installment_state_at',
                self::tableName() . '.due_date',
                self::tableName() . '.outstanding_principal_amount',
                self::tableName() . '.outstanding_income_amount',
                self::tableName() . '.outstanding_receivable_amount',
                self::tableName() . '.not_yet_due_amount',
                self::tableName() . '.overdue_1_10_amount',
                self::tableName() . '.overdue_11_30_amount',
                self::tableName() . '.overdue_31_60_amount',
                self::tableName() . '.overdue_61_90_amount',
                self::tableName() . '.overdue_over_90_amount',
                self::tableName() . '.total_overdue_amount',
                self::tableName() . '.previous_fine_amount',
                self::tableName() . '.new_fine_amount',
                self::tableName() . '.overdue_day_total',
                self::tableName() . '.last_payment_date',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
                Debtor::tableName() . '.name AS debtor',
                Disbursement::tableName() . '.contract_number',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->leftJoin(Application::tableName(), Application::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Disbursement::tableName(), Disbursement::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . Application::tableName() . '.debtor_number')
            ->where([self::tableName() . '.id' => $id]);

        return $query->one();
    }

    public static function getReportAging($params)
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.application_number',
                self::tableName() . '.installment_amount',
                self::tableName() . '.installment_state_at',
                self::tableName() . '.due_date',
                self::tableName() . '.outstanding_principal_amount',
                self::tableName() . '.outstanding_income_amount',
                self::tableName() . '.outstanding_receivable_amount',
                self::tableName() . '.not_yet_due_amount',
                self::tableName() . '.overdue_1_10_amount',
                self::tableName() . '.overdue_11_30_amount',
                self::tableName() . '.overdue_31_60_amount',
                self::tableName() . '.overdue_61_90_amount',
                self::tableName() . '.overdue_over_90_amount',
                self::tableName() . '.total_overdue_amount',
                self::tableName() . '.previous_fine_amount',
                self::tableName() . '.new_fine_amount',
                self::tableName() . '.overdue_day_total',
                self::tableName() . '.last_payment_date',
                self::tableName() . '.last_payment_date',
                'DATE(' . self::tableName() . '.created_at) AS created_at',
                Partner::tableName() . '.name AS partner',
                Partner::tableName() . '.code AS partner_code',
                Partner::tableName() . '.margin_percentage',
                Partner::tableName() . '.addm_addb',
                Debtor::tableName() . '.name AS debtor',
                Debtor::tableName() . '.debtor_number',
                Debtor::tableName() . '.address',
                Debtor::tableName() . '.zip_code',
                Debtor::tableName() . '.phone_number',
                Debtor::tableName() . '.cellphone_number',
                Application::tableName() . '.loan_term',
                Application::tableName() . '.period_type',
                Application::tableName() . '.due_date AS application_due_date',
                Application::tableName() . '.first_installment_date',
                Application::tableName() . '.initial_loan_principal',
                Disbursement::tableName() . '.contract_number',
                Disbursement::tableName() . '.disbursement_date',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->leftJoin(Application::tableName(), Application::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Disbursement::tableName(), Disbursement::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . Application::tableName() . '.debtor_number');
        $query->andFilterWhere(['=', self::tableName() . '.partner_id', $params['partner_id']]);   
        $query->andFilterWhere(['>=', self::tableName() . '.created_at', $params['date_from']])
            ->andFilterWhere(['<=', self::tableName() . '.created_at', $params['date_until']]);
        $query->orderBy(['id' => SORT_DESC]);
        $models = $query->all();
        
        $result = [];
        foreach ($models as $model) {
            $result[] = [
                'kode supplier' => $model['partner_code'],
                'nama supplier' => $model['partner'],
                'no kontrak internal' => $model['application_number'],
                'no kontrak supplier' => $model['contract_number'],
                'no debitur' => $model['debtor_number'],
                'nama debitur' => $model['debtor'],
                'alamat' => $model['address'],
                'kode pos' => $model['zip_code'],
                'no telepon' => $model['phone_number'],
                'no hp' => $model['cellphone_number'],
                'kode supplier' => $model['partner_code'],
                'nama supplier' => $model['partner'],
                'produk' => $model['partner'],
                'unit' => '1',
                'used / new' => 'N',
                'addm / addb' => $model['addm_addb'],
                'expected yield' => $model['margin_percentage'],
                'jangka waktu' => $model['loan_term'] . ' ' . $model['period_type'],
                'tanggal disburse' => $model['disbursement_date'],
                'tanggal angsuran ke-1' => $model['first_installment_date'],
                'tanggal jatuh tempo' => $model['application_due_date'],
                'currency' => 'IDR',
                'pokok awal' => $model['initial_loan_principal'],
                'angsuran' => $model['installment_amount'],
                'angsuran ke' => $model['installment_state_at'],
                'due_date' => $model['due_date'],
                'oustanding principal' => $model['outstanding_principal_amount'],
                'oustanding income' => $model['outstanding_income_amount'],
                'oustanding receivable' => $model['outstanding_receivable_amount'],
                'not yet due' => $model['not_yet_due_amount'],
                'overdue 1-10' => $model['overdue_1_10_amount'],
                'overdue 11-30' => $model['overdue_11_30_amount'],
                'overdue 31-60' => $model['overdue_31_60_amount'],
                'overdue 61-90' => $model['overdue_61_90_amount'],
                'overdue > 90' => $model['overdue_over_90_amount'],
                'total overdue' => $model['total_overdue_amount'],
                'total denda sebelumnya' => $model['previous_fine_amount'],
                'denda baru' => $model['new_fine_amount'],
                'hari overdue' => $model['overdue_day_total'],
                'tanggal bayar terakhir' => $model['last_payment_date'],
            ];
        }

        return $result;
    }
}
