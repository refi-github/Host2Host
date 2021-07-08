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
    const PAGE_SIZE = 10;

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

    public static function getAll($params = [])
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.application_number',
                self::tableName() . '.contract_number',
                self::tableName() . '.disbursement_date',
                self::tableName() . '.amount',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
                Debtor::tableName() . '.name AS debtor',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
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

        if (isset($params['disbursement_date_from']) && isset($params['disbursement_date_until']) && $params['disbursement_date_from'] != null && $params['disbursement_date_until'] != null) {
            $query->andFilterWhere(['>=', self::tableName() . '.disbursement_date', $params['disbursement_date_from']])
                ->andFilterWhere(['<=', self::tableName() . '.disbursement_date', $params['disbursement_date_until']]);
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

    public static function getReportDisbursement($params)
    {
        $query = self::find()
            ->asArray()
            ->select([
                self::tableName() . '.id',
                self::tableName() . '.application_number',
                self::tableName() . '.contract_number',
                self::tableName() . '.disbursement_date',
                self::tableName() . '.amount',
                self::tableName() . '.created_at',
                Partner::tableName() . '.name AS partner',
                Partner::tableName() . '.code',
                Partner::tableName() . '.financing_type',
                Partner::tableName() . '.financing_scheme',
                Partner::tableName() . '.margin_percentage',
                Partner::tableName() . '.addm_addb',
                Debtor::tableName() . '.name AS debtor',
                Debtor::tableName() . '.debtor_number',
                Debtor::tableName() . '.id_card_number',
                Debtor::tableName() . '.birth_place',
                Debtor::tableName() . '.birth_date',
                Debtor::tableName() . '.gender',
                Debtor::tableName() . '.mother_name',
                Debtor::tableName() . '.tax_number',
                Debtor::tableName() . '.cellphone_number',
                Debtor::tableName() . '.email',
                Debtor::tableName() . '.phone_number',
                Debtor::tableName() . '.address',
                Debtor::tableName() . '.sub_district',
                Debtor::tableName() . '.district',
                Debtor::tableName() . '.city',
                Debtor::tableName() . '.province',
                Debtor::tableName() . '.zip_code',
                Debtor::tableName() . '.religion',
                Debtor::tableName() . '.education',
                Debtor::tableName() . '.profession',
                Debtor::tableName() . '.company_name',
                Debtor::tableName() . '.business_field',
                Debtor::tableName() . '.position',
                Debtor::tableName() . '.company_phone',
                Debtor::tableName() . '.company_email',
                Debtor::tableName() . '.company_address',
                Debtor::tableName() . '.company_sub_district',
                Debtor::tableName() . '.company_district',
                Debtor::tableName() . '.company_city',
                Debtor::tableName() . '.company_province',
                Debtor::tableName() . '.company_zip_code',
                Debtor::tableName() . '.monthly_income',
                Debtor::tableName() . '.marital_status',
                Debtor::tableName() . '.dependents_total',
                Debtor::tableName() . '.family_card_number',
                Debtor::tableName() . '.spouse_name',
                Debtor::tableName() . '.spouse_id_card_number',
                Debtor::tableName() . '.spouse_profession',
                Debtor::tableName() . '.spouse_monthly_income',
                Application::tableName() . '.loan_date',
                Application::tableName() . '.start_date',
                Application::tableName() . '.due_date',
                Application::tableName() . '.product_service_amount',
                Application::tableName() . '.down_payment',
                Application::tableName() . '.admin_provision_fee',
                Application::tableName() . '.service_fee',
                Application::tableName() . '.initial_loan_principal',
                Application::tableName() . '.loan_term',
                Application::tableName() . '.period_type',
                Application::tableName() . '.margin_amount',
                Application::tableName() . '.loan_amount',
                Application::tableName() . '.installment_amount',
                Application::tableName() . '.first_installment_date',
            ])
            ->leftJoin(Partner::tableName(), Partner::tableName() . '.id = ' . self::tableName() . '.partner_id')
            ->leftJoin(Application::tableName(), Application::tableName() . '.application_number = ' . self::tableName() . '.application_number')
            ->leftJoin(Debtor::tableName(), Debtor::tableName() . '.debtor_number = ' . Application::tableName() . '.debtor_number');
        $query->andFilterWhere(['=', self::tableName() . '.partner_id', $params['partner_id']]);   
        $query->andFilterWhere(['>=', self::tableName() . '.disbursement_date', $params['date_from']])
            ->andFilterWhere(['<=', self::tableName() . '.disbursement_date', $params['date_until']]);
        $query->orderBy(['id' => SORT_DESC]);
        $models = $query->all();
        
        $result = [];
        $i = 1;
        foreach ($models as $model) {
            $result[] = [
                'flag' => 'D',
                'no urut' => $i,
                'kode supplier' => $model['code'],
                'no kontrak internal' => $model['application_number'],
                'no kontrak supplier' => $model['contract_number'],
                'no debitur' => $model['debtor_number'],
                'tanggal akad' => $model['loan_date'],
                'jenis pembiayaan' => $model['financing_type'],
                'skema pembiayaan' => $model['financing_scheme'],
                'supplier' => $model['partner'],
                'produk' => $model['partner'],
                'tanggal mulai' => $model['start_date'],
                'tanggal jatuh tempo' => $model['due_date'],
                'nilai barang jasa yang dibiayai' => $model['product_service_amount'],
                'uang muka' => $model['down_payment'],
                'admin atau provisi' => $model['admin_provision_fee'],
                'service fee' => $model['service_fee'],
                'nilai disburse' => $model['amount'],
                'tanggal disburse' => $model['disbursement_date'],
                'pokok awal' => $model['initial_loan_principal'],
                'expected yield per tahun' => $model['margin_percentage'],
                'tenor' => $model['loan_term'],
                'periode' => $model['period_type'],
                'addm/addb' => $model['addm_addb'],
                'margin' => $model['margin_amount'],
                'nilai pembiayaan' => $model['loan_amount'],
                'nilai angsuran' => $model['installment_amount'],
                'tanggal angsuran ke-1' => $model['first_installment_date'],
                'nama debitur' => $model['debtor'],
                'nomor ktp' => $model['id_card_number'],
                'tempat lahir' => $model['birth_place'],
                'tanggal lahir' => $model['birth_date'],
                'jenis kelamin' => $model['gender'],
                'nama ibu kandung' => $model['mother_name'],
                'npwp' => $model['tax_number'],
                'handphone' => $model['cellphone_number'],
                'email' => $model['email'],
                'telepon' => $model['phone_number'],
                'alamat' => $model['address'],
                'kelurahan' => $model['sub_district'],
                'kecamatan' => $model['district'],
                'kota' => $model['city'],
                'provinsi' => $model['province'],
                'kode pos' => $model['zip_code'],
                'agama' => $model['religion'],
                'pendidikan' => $model['education'],
                'pekerjaan' => $model['profession'],
                'nama perusahaan / tempat usaha' => $model['company_name'],
                'bidang usaha' => $model['business_field'],
                'jabatan' => $model['position'],
                'telepon pekerjaan' => $model['company_phone'],
                'email pekerjaan' => $model['company_email'],
                'alamat pekerjaan' => $model['company_address'],
                'kelurahaan pekerjaan' => $model['company_sub_district'],
                'kecamatan pekerjaan' => $model['company_district'],
                'kota pekerjaan' => $model['company_city'],
                'provinsi pekerjaan' => $model['company_province'],
                'kode pos pekerjaan' => $model['company_zip_code'],
                'income' => $model['monthly_income'],
                'marital status' => $model['marital_status'],
                'jumlah tanggungan' => $model['dependents_total'],
                'no kartu keluarga' => $model['family_card_number'],
                'spouse name' => $model['spouse_name'],
                'spouse ktp' => $model['spouse_id_card_number'],
                'spouse pekerjaan' => $model['spouse_profession'],
                'spouse income' => $model['spouse_monthly_income'],
            ];

            $i++;
        }

        return $result;
    }
}
