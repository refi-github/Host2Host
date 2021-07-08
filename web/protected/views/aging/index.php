<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Application;
use app\models\User;
use app\models\Partner;

$pageName = 'Aging';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>

<style>
    table th,
    table td  {
        vertical-align: middle !important;
        white-space:nowrap;
    }
</style>

<div class="aging-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?= Html::tag('h4', Html::encode($pageName), ['class' => 'card-title mb-4']) ?>
                    
                    <?= Html::button('<i class="fa fa-search"></i> Pencarian', [
                        'class' => 'btn btn-sm btn-outline-info waves-effect waves-light',
                        'data-toggle' => 'modal',
                        'data-target' => '.search-modal',
                    ]) ?>

                    <div class="table-responsive mt-3">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="1">#</th>
                                    <th>Mitra</th>
                                    <th>Debitur</th>
                                    <th>Nomor Pengajuan</th>
                                    <th>Nomor Kontrak</th>
                                    <th>NIlai Angsuran</th>
                                    <th>Angsuran Ke</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>Total Overdue</th>
                                    <th>Hari Overdue</th>
                                    <th>Tanggal Bayar Terakhir</th>
                                    <th>Tanggal Dibuat</th>
                                    <th width="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = $pagination->offset + 1;
                            if (!empty($models)) {
                                foreach ($models as $model) {
                            ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $model['partner']; ?></td>
                                        <td><?= $model['debtor']; ?></td>
                                        <td><?= $model['application_number']; ?></td>
                                        <td><?= $model['contract_number']; ?></td>
                                        <td><?= number_format($model['installment_amount']); ?></td>
                                        <td><?= $model['installment_state_at']; ?></td>
                                        <td><?= $model['due_date']; ?></td>
                                        <td><?= number_format($model['total_overdue_amount']); ?></td>
                                        <td><?= $model['overdue_day_total']; ?></td>
                                        <td><?= $model['last_payment_date']; ?></td>
                                        <td><?= $model['created_at']; ?></td>
                                        <td>
                                            <?= Html::a('<i class="fa fa-search"></i>', [
                                                'aging/view', 
                                                'id' => $model['id'],
                                            ], 
                                            [
                                                'title' => 'Detail',
                                                'class' => 'btn btn-sm btn-outline-success'
                                            ]); ?>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo '<td colspan="100" class="text-center">Data tidak ditemukan</td>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
            
                    <nav class="mt-2">
                        <?= LinkPager::widget([
                            'pagination' => $pagination,
                            'disabledPageCssClass' => 'page-link',
                            'options' => ['class' => 'pagination pagination-split'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link'],
                        ]); ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->   
</div>

<!--  Modal content for the above example -->
<div class="modal fade search-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <?= Html::tag('h4', 'Pencarian', [
                    'class' => 'modal-title',
                    'id' => 'myLargeModalLabel',
                ]) ?>
            </div>
            <div class="modal-body">
                
                <?= Html::beginForm(['aging/index'], 'get', ['id' => 'application-search-form']) ?>

                    <div class="row">
                        <?php
                        if (Yii::$app->user->identity->role == User::ROLE_ADMIN || Yii::$app->user->identity->role == User::ROLE_STAFF) :
                        ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= Html::tag('label', 'Mitra', ['for' => 'partner_id']) ?>
                                    <?= Html::dropDownList('partner_id', Yii::$app->request->get('partner_id'), ArrayHelper::map(Partner::find()->all(), 'id', 'name'), [
                                        'class' => 'form-control select2', 
                                        'id' => 'partner_id', 
                                        'prompt' => '- Pilih Mitra -',
                                    ]) ?>
                                </div>
                            </div>
                        <?php
                        endif
                        ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::tag('label', 'Nama Debitur', ['for' => 'debtor_name']) ?>
                                <?= Html::input('text', 'debtor_name', Yii::$app->request->get('debtor_name'), [
                                    'class' => 'form-control', 
                                    'id' => 'debtor_name',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::tag('label', 'Nomor Pengajuan', ['for' => 'application_number']) ?>
                                <?= Html::input('text', 'application_number', Yii::$app->request->get('application_number'), [
                                    'class' => 'form-control', 
                                    'id' => 'application_number',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::tag('label', 'Nomor Kontrak', ['for' => 'contract_number']) ?>
                                <?= Html::input('text', 'contract_number', Yii::$app->request->get('contract_number'), [
                                    'class' => 'form-control', 
                                    'id' => 'contract_number',
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Cari', ['class' => 'btn btn-info waves-effect waves-light']) ?>
                    </div>

                <?= Html::endForm() ?>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->