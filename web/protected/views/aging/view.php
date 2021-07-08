<?php

use yii\helpers\Html;

$pageName = 'Detail Aging';
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
                            <b>Nomor Kontrak</b> <br>
                            <?= $model['application_number']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Nilai Angsuran</b> <br>
                            <?= number_format($model['installment_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Angsuran Ke</b> <br>
                            <?= $model['installment_state_at']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Jatuh Tempo</b> <br>
                            <?= $model['due_date']; ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Outstanding Principal</b> <br>
                            <?= number_format($model['outstanding_principal_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Outstanding Income</b> <br>
                            <?= number_format($model['outstanding_income_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Outstanding Receivable</b> <br>
                            <?= number_format($model['outstanding_receivable_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Not Yet Due</b> <br>
                            <?= number_format($model['not_yet_due_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Overdue 1-10</b> <br>
                            <?= number_format($model['overdue_1_10_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Overdue 11-30</b> <br>
                            <?= number_format($model['overdue_11_30_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Overdue 31-60</b> <br>
                            <?= number_format($model['overdue_31_60_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Overdue 61-90</b> <br>
                            <?= number_format($model['overdue_61_90_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Overdue > 90</b> <br>
                            <?= number_format($model['overdue_over_90_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Total Overdue</b> <br>
                            <?= number_format($model['total_overdue_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Total Denda Sebelumnya</b> <br>
                            <?= number_format($model['previous_fine_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Total Denda Baru</b> <br>
                            <?= number_format($model['new_fine_amount']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Hari Overdue</b> <br>
                            <?= number_format($model['overdue_day_total']); ?>
                        </div>
                        <div class="col-md-6 mb-4">
                            <b>Tanggal Bayar Terakhir</b> <br>
                            <?= $model['last_payment_date']; ?>
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
 