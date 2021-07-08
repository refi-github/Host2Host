<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Application;
use app\models\User;
use app\models\Partner;

$pageName = 'Application';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>

<style>
    table th,
    table td  {
        vertical-align: middle !important;
        white-space:nowrap;
    }
</style>

<div class="application-index">
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
                                    <th>Tanggal Akad</th>
                                    <th>Tenor</th>
                                    <th>Periode</th>
                                    <th>Nilai Barang Jasa</th>
                                    <th>Nilai Angsuran</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Status</th>
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
                                        <td><?= $model['loan_date']; ?></td>
                                        <td><?= $model['loan_term']; ?></td>
                                        <td><?= $model['period_type']; ?></td>
                                        <td><?= number_format($model['product_service_amount']); ?></td>
                                        <td><?= number_format($model['installment_amount']); ?></td>
                                        <td><?= $model['created_at']; ?></td>
                                        <td><?= Application::getStatuses($model['status']); ?></td>
                                        <td>
                                            <?= Html::a('<i class="fa fa-search"></i>', [
                                                'application/view', 
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
                
                <?= Html::beginForm(['application/index'], 'get', ['id' => 'application-search-form']) ?>

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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= Html::tag('label', 'Tanggal Akad', ['for' => 'loan_date_from']) ?>
                                        <div class="input-group">
                                            <?= Html::input('text', 'loan_date_from', Yii::$app->request->get('loan_date_from'), [
                                                'class' => 'form-control datepicker', 
                                                'id' => 'loan_date_from',
                                                'placeholder' => 'Dari',
                                                'autocomplete' => 'off',
                                            ]) ?>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= Html::tag('label', '&nbsp;', ['for' => 'loan_date_until']) ?>
                                        <div class="input-group">
                                            <?= Html::input('text', 'loan_date_until', Yii::$app->request->get('loan_date_until'), [
                                                'class' => 'form-control datepicker', 
                                                'id' => 'loan_date_until',
                                                'placeholder' => 'Sampai',
                                                'autocomplete' => 'off',
                                            ]) ?>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
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