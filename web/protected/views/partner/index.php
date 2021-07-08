<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$pageName = 'Mitra';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>

<style>
    table th,
    table td  {
        vertical-align: middle !important;
        white-space:nowrap;
    }
</style>

<div class="partner-index">
    <div class="row">
        <div class="col-lg-12">
            <?php 
            if (Yii::$app->session->hasFlash('alert')) 
                : echo Yii::$app->session->getFlash('alert'); 
            endif 
            ?>

            <div class="card">
                <div class="card-body">
                    <?= Html::tag('h4', Html::encode($pageName), ['class' => 'card-title mb-4']) ?>
                    
                    <?= Html::a('<i class="fa fa-plus"></i> Tambah', [
                        'partner/create',
                    ], 
                    [
                        'class' => 'btn btn-sm btn-outline-warning'
                    ]); ?>

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
                                    <th>Kode Supplier</th>
                                    <th>Nama</th>
                                    <th width="120"></th>
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
                                        <td><?= $model['code']; ?></td>
                                        <td><?= $model['name']; ?></td>
                                        <td>
                                            <?= Html::a('<i class="fa fa-edit"></i>', [
                                                'partner/update', 
                                                'id' => $model['id'],
                                            ], 
                                            [
                                                'title' => 'Ubah',
                                                'class' => 'btn btn-sm btn-outline-info'
                                            ]); ?>    
                                            <?= Html::a('<i class="fa fa-trash"></i>', [
                                                'partner/delete', 
                                                'id' => $model['id'],
                                            ], 
                                            [
                                                'title' => 'Hapus',
                                                'class' => 'btn btn-sm btn-outline-danger',
                                                'data-confirm' => 'Yakin ingin menghapus?',
                                                'data-method' => 'post',
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
                
                <?= Html::beginForm(['partner/index'], 'get', ['id' => 'partner-search-form']) ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?= Html::tag('label', 'Nama', ['for' => 'name']) ?>
                                <?= Html::input('text', 'name', Yii::$app->request->get('name'), [
                                    'class' => 'form-control', 
                                    'id' => 'name',
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