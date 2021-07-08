<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$pageName = 'Ruang Lingkup Usaha';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>
<div class="business-scope-index">
    <div class="row">
        <div class="col-lg-12">
            <?php 
            if (Yii::$app->session->hasFlash('alert')) 
                : echo Yii::$app->session->getFlash('alert'); 
            endif 
            ?>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><?= $pageName; ?></h4>

                    <?= Html::a('<i class="fa fa-plus"></i> Tambah', [
                        'business-scope/create',
                    ], 
                    [
                        'class' => 'btn btn-sm btn-outline-warning'
                    ]); ?>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="1">#</th>
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
                                        <td><?= $model['name']; ?></td>
                                        <td>
                                            <?= Html::a('<i class="fa fa-edit"></i>', [
                                                'business-scope/update', 
                                                'id' => $model['id'],
                                            ], 
                                            [
                                                'title' => 'Ubah',
                                                'class' => 'btn btn-sm btn-outline-info'
                                            ]); ?>    
                                            <?= Html::a('<i class="fa fa-trash"></i>', [
                                                'business-scope/delete', 
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
 