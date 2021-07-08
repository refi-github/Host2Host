<?php

use yii\helpers\Html;
use app\models\Application;

$pageName = 'Detail Application';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>
<div class="application-view">
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
                            <b>Debitur</b> <br>
                            <?= $model['debtor']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nomor Pengajuan</b> <br>
                            <?= $model['application_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Akad</b> <br>
                            <?= $model['loan_date']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Mulai</b> <br>
                            <?= $model['start_date']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Jatuh Tempo</b> <br>
                            <?= $model['due_date']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nilai Barang Jasa</b> <br>
                            <?= number_format($model['product_service_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Uang Muka</b> <br>
                            <?= number_format($model['down_payment']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Admin atau Provisi</b> <br>
                            <?= number_format($model['admin_provision_fee']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Service Fee</b> <br>
                            <?= number_format($model['service_fee']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Pokok Awal</b> <br>
                            <?= number_format($model['initial_loan_principal']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tenor</b> <br>
                            <?= $model['loan_term']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Periode</b> <br>
                            <?= $model['period_type']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Margin</b> <br>
                            <?= number_format($model['margin_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nilai Pembiayaan</b> <br>
                            <?= number_format($model['loan_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nilai Angsuran</b> <br>
                            <?= number_format($model['installment_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Angsuran Ke-1</b> <br>
                            <?= $model['first_installment_date']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Dibuat</b> <br>
                            <?= $model['created_at']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Status</b> <br>
                            <?= Application::getStatuses($model['status']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->   
</div>
 