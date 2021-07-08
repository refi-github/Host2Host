<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\User;
use app\models\Partner;

$pageName = 'Debtor';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>
<div class="debtor-index">
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
                                    <th>Nomor Debitur</th>
                                    <th>Nama</th>
                                    <th>No KTP</th>
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
                                        <td><?= $model['debtor_number']; ?></td>
                                        <td><?= $model['name']; ?></td>
                                        <td><?= $model['id_card_number']; ?></td>
                                        <td><?= $model['created_at']; ?></td>
                                        <td>
                                            <?= Html::a('<i class="fa fa-search"></i>', [
                                                'debtor/view', 
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
                
                <?= Html::beginForm(['debtor/index'], 'get', ['id' => 'debtor-search-form']) ?>

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
                                <?= Html::tag('label', 'Nomor Debitur', ['for' => 'debtor_number']) ?>
                                <?= Html::input('text', 'debtor_number', Yii::$app->request->get('debtor_number'), [
                                    'class' => 'form-control', 
                                    'id' => 'debtor_number',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::tag('label', 'Nama', ['for' => 'name']) ?>
                                <?= Html::input('text', 'name', Yii::$app->request->get('name'), [
                                    'class' => 'form-control', 
                                    'id' => 'name',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::tag('label', 'No KTP', ['for' => 'id_card_number']) ?>
                                <?= Html::input('text', 'id_card_number', Yii::$app->request->get('id_card_number'), [
                                    'class' => 'form-control', 
                                    'id' => 'id_card_number',
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