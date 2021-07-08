<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
// use app\models\Dashboard;
use app\models\Partner;
use app\models\User;
use onmotion\apexcharts\ApexchartsWidget;

$this->title = 'Beranda - ' . Yii::$app->name;
?>

<style>
.site-index {
    font-size: 12px;
}

.mitra-name {
    margin: 0;
    padding: 0;
}
</style>

<div class="site-index">
    <div class="content">
        <div class="container-fluid">
            <?php
            if (isset(Yii::$app->user->identity->username) 
                && Yii::$app->user->identity->role == User::ROLE_ADMIN) :
            ?>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <?= Html::beginForm(['site/index'], 'get', [
                                'enctype' => 'multipart/form-data', 
                                'id' => 'site-form', 
                                'onchange' => 'submit()',
                            ]) ?>

                        <?= Html::dropDownList('partner_id', 
                            Yii::$app->request->get('partner_id'), 
                            ArrayHelper::map(Partner::find()->all(), 'id', 'name'), 
                            [
                                'class' => 'form-control select2', 
                                'prompt' => '- Pilih Mitra -'
                            ]) ?>

                        <?= Html::endForm() ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <h2 class="mitra-name"><?= $partnerName; ?></h2>
                    </div>
                </div>
            <?php
            endif;
            ?>

            <div class="row">
                <div class="col-md-3">
                    <div class="card-box widget-flat border-custom bg-custom text-white text-center">
                        <i class="fa fa-file-text"></i>
                        <p class="text-uppercase font-weight-bold mb-2">APPLICATIONS</p>
                        <p class="mb-0">IDR <?= $dashboard['applicationLoanAmount']; ?></p>
                        <p class="mb-0"><?= number_format($dashboard['applicationTotalAccount']); ?> Accounts</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box widget-flat border-custom bg-custom text-white text-center">
                        <i class="fa fa-check-square-o"></i>
                        <p class="text-uppercase font-weight-bold mb-2">APPROVAL</p>
                        <p class="mb-0">IDR <?= $dashboard['applicationLoanAmount']; ?></p>
                        <p class="mb-0">100% Approval Rate</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box widget-flat border-custom bg-custom text-white text-center">
                        <i class="fa fa-calendar-check-o"></i>
                        <p class="text-uppercase font-weight-bold mb-2">DISBURSEMENT</p>
                        <p class="mb-0">IDR <?= $dashboard['disbursementLoanAmount']; ?></p>
                        <p class="mb-0"><?= number_format($dashboard['disbursementTotalAccount']); ?> Accounts</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box widget-flat border-custom bg-custom text-white text-center">
                        <i class="fa fa-group"></i>
                        <p class="text-uppercase font-weight-bold mb-2">ACCOUNTS <br>COLLECTED</p>
                        <p class="mb-0"><?= number_format($dashboard['paymentTotalAccount']); ?> Accounts</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body">
                        <h4 class="card-title border-bottom border-info">TODAY PERFORMANCE</h4>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">APPLICATIONS</h6>
                                <p class="mb-0">IDR <?= $dashboard['todayApplicationLoanAmount']; ?></p>
                                <p class="mb-0"><?= number_format($dashboard['todayApplicationTotalAccount']); ?> Accounts</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">APPROVAL</h6>
                                <p class="mb-0">IDR <?= $dashboard['todayApplicationLoanAmount']; ?></p>
                                <p class="mb-0">0% Approval Rate</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">DISBURSEMENT</h6>
                                <p class="mb-0">IDR <?= $dashboard['todayDisbursementLoanAmount']; ?></p>
                                <p class="mb-0"><?= number_format($dashboard['todayDisbursementTotalAccount']); ?> Accounts</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">ACCOUNTS <br>COLLECTED</h6>
                                <p class="mb-0"><?= number_format($dashboard['todayPaymentTotalAccount']); ?> Accounts</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body mt-4">
                        <h4 class="card-title border-bottom border-info">THIS MONTH PERFORMANCE</h4>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">APPLICATIONS</h6>
                                <p class="mb-0">IDR <?= $dashboard['thisMonthApplicationLoanAmount']; ?></p>
                                <p class="mb-0"><?= number_format($dashboard['thisMonthApplicationTotalAccount']); ?> Accounts</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">APPROVAL</h6>
                                <p class="mb-0">IDR <?= $dashboard['thisMonthApplicationLoanAmount']; ?></p>
                                <p class="mb-0">0% Approval Rate</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">DISBURSEMENT</h6>
                                <p class="mb-0">IDR <?= $dashboard['thisMonthDisbursementLoanAmount']; ?></p>
                                <p class="mb-0"><?= number_format($dashboard['thisMonthDisbursementTotalAccount']); ?> Accounts</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <h6 class="font-weight-bold">ACCOUNTS <br>COLLECTED</h6>
                                <p class="mb-0"><?= number_format($dashboard['thisMonthPaymentTotalAccount']); ?> Accounts</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-body">
                        <h4 class="card-title border-bottom border-info">POSITION [<?= date("Y"); ?>]</h4>
                        <?php
                        echo ApexchartsWidget::widget([
                                'type' => 'line',
                                'chartOptions' => [
                                    'chart' => [
                                        'toolbar' => [
                                            'show' => true,
                                        ],
                                        'animations' => [
                                            'enabled' => false,
                                        ],
                                    ],
                                    'xaxis' => [
                                        'categories' => $chart['categories'],
                                    ],
                                    'yaxis' => [
                                        'show' => true,
                                        'forceNiceScale' => true,
                                    ],
                                    'dataLabels' => [
                                        'enabled' => false,
                                    ],
                                    'stroke' => [
                                        'show' => true,
                                    ],
                                ],
                                'series' => $chart['series'],
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
