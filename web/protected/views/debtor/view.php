<?php

use yii\helpers\Html;

$pageName = 'Detail Debtor';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>
<div class="debtor-view">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><?= $pageName; ?></h4>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <b>Mitra</b> <br>
                            <?= $model['partner']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nomor Debitur</b> <br>
                            <?= $model['debtor_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nama</b> <br>
                            <?= $model['name']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>No KTP</b> <br>
                            <?= $model['id_card_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tempat Lahir</b> <br>
                            <?= $model['birth_place']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Lahir</b> <br>
                            <?= $model['birth_date']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Jenis Kelamin</b> <br>
                            <?= $model['gender']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nama Ibu Kandung</b> <br>
                            <?= $model['mother_name']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>NPWP</b> <br>
                            <?= $model['tax_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>No Telp</b> <br>
                            <?= $model['phone_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>No HP</b> <br>
                            <?= $model['cellphone_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Email</b> <br>
                            <?= $model['email']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Alamat</b> <br>
                            <?= $model['address']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kelurahan</b> <br>
                            <?= $model['sub_district']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kecamatan</b> <br>
                            <?= $model['district']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kota</b> <br>
                            <?= $model['city']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Provinse</b> <br>
                            <?= $model['province']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kode Pos</b> <br>
                            <?= $model['zip_code']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Agama</b> <br>
                            <?= $model['religion']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Pendidikan</b> <br>
                            <?= $model['education']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Pekerjaan</b> <br>
                            <?= $model['profession']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nama Perusahaan / Tempat Usaha</b> <br>
                            <?= $model['company_name']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Bidang Usaha</b> <br>
                            <?= $model['business_field']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Jabatan</b> <br>
                            <?= $model['position']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>No Telp Perusahaan</b> <br>
                            <?= $model['company_phone']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Email Perusahaan</b> <br>
                            <?= $model['company_email']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Alamat Perusahaan</b> <br>
                            <?= $model['company_address']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kelurahan Perusahaan</b> <br>
                            <?= $model['company_sub_district']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kecamatan Perusahaan</b> <br>
                            <?= $model['company_district']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kota Perusahaan</b> <br>
                            <?= $model['company_city']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Provinsi Perusahaan</b> <br>
                            <?= $model['company_province']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Kode Pos Perusahaan</b> <br>
                            <?= $model['company_zip_code']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Penghasilan Per Bulan</b> <br>
                            <?= number_format($model['monthly_income']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Status Pernikahan</b> <br>
                            <?= $model['marital_status']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Jumlah Tanggungan</b> <br>
                            <?= $model['dependents_total']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>No Kartu Keluarga</b> <br>
                            <?= $model['family_card_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nama Pasangan</b> <br>
                            <?= $model['spouse_name']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>No KTP Pasangan</b> <br>
                            <?= $model['spouse_id_card_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Pekerjaan Pasangan</b> <br>
                            <?= $model['spouse_profession']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Penghasilan Pasangan</b> <br>
                            <?= number_format($model['spouse_monthly_income']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Dibuat</b> <br>
                            <?= $model['created_at']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->   
</div>
 