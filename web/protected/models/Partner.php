<?php

namespace app\models;

use Yii;

class Partner extends \yii\db\ActiveRecord
{
    const GO_PUBLIC = 1;
    const NOT_GO_PUBLIC = 2;

    const REGISTERED_ON_OJK = 1;
    const NOT_REGISTERED_ON_OJK = 2;

    const WELL_KNOWN_COMPANY = 1;
    const NOT_WELL_KNOWN_COMPANY = 2;

    const INTEREST_TYPE_ANNUITY = 1;
    const INTEREST_TYPE_FLAT = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const PAGE_SIZE = 10;

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
            [['margin_percentage', 'fund_management_amount', 'percentage_share_ownership', 'minimum_loan_amount', 'maximum_loan_amount'], 'number'],
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
            'code' => 'Kode Supplier',
            'name' => 'Nama Mitra',
            'financing_type' => 'Jenis Pembiayaan',
            'financing_scheme' => 'Skema Pembiayaan',
            'margin_percentage' => 'Persentase Margin',
            'addm_addb' => 'ADDM / ADDB',
            'identity_number' => 'No Identitas',
            'establishment_number' => 'No Akta Pendirian',
            'establishment_place' => 'Tempat Pendirian',
            'establishment_date' => 'Tanggal Akta Pendirian',
            'last_change_number' => 'No Akta Perubahan Terakhir',
            'last_change_date' => 'Tanggal Akta Perubahan Terakhir',
            'phone_number' => 'No Telp',
            'cellphone_number' => 'No HP',
            'email' => 'Email',
            'address' => 'Alamat',
            'sub_district' => 'Kelurahan',
            'district' => 'Kecamatan',
            'city' => 'Kota',
            'province' => 'Provinsi',
            'zip_code' => 'Kode Pos',
            'country_code' => 'Kode Negara',
            'business_field_code' => 'Kode Bidang Usaha',
            'reporter_relationship_code' => 'Kode Hubungan Dengan Pelapor',
            'go_public' => 'Go Public',
            'debtor_class_code' => 'Kode Golongan Debitur',
            'debtor_rating' => 'Peringkat Atau Rating Debitur',
            'rating_agency' => 'Lembaga Pemeringkat Atau Rating',
            'rating_date' => 'Tanggal Pemeringkatan',
            'debtor_business_group' => 'Nama Grup Usaha Debitur',
            'branch_office_code' => 'Kode Kantor Cabang',
            'fund_management_amount' => 'Dana Kelola',
            'interest_type' => 'Jenis Suku Bunga',
            'due_date' => 'Tanggal Jatuh Tempo',
            'start_date' => 'Tanggal Mulai',
            'end_date' => 'Tanggal Akhir',
            'establishment_date_according_to_ahu' => 'Tanggal Berdiri Menurut AHU',
            'business_scope_id' => 'Ruang Lingkup Usaha',
            'registered_on_ojk' => 'Terdaftar OJK',
            'percentage_share_ownership' => 'Persentase Kepemilikan Saham',
            'well_known_company' => 'Merupakan Perusahaan Ternama',
            'financial_performance_id' => 'Kinerja Keuangan',
            'minimum_loan_amount' => 'Jumlah Minimum Peminjaman',
            'maximum_loan_amount' => 'Jumlah Maksimum Peminjaman',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
    
    public static function getAll($params = [])
    {
        $query = self::find()
            ->asArray();

        if (isset($params['name']) && $params['name'] != null) {
            $query->andFilterWhere(['like', self::tableName() . '.name', $params['name']]);   
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

        if (isset($params['name']) && $params['name'] != null) {
            $query->andFilterWhere(['like', self::tableName() . '.name', $params['name']]);   
        }

        return $query->count();
    }

    public function generatePrefix()
    {
        return $this->prefix = strtoupper(substr($this->name, 0, 2)) . rand(00, 99);
    }

    public static function getStatuses($status = null)
    {
        $results = [
            self::STATUS_ACTIVE => 'ACTIVE',
            self::STATUS_INACTIVE => 'INACTIVE',
        ];

        if ($status != null) {
            return $results[$status];
        }

        return $results;
    }
}
