<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Partner;

$pageName = 'Report Aging';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>

<div class="report-aging-index">
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

                    <?= Html::beginForm(['report-aging/index'], 'post', ['id' => 'report-aging-search-form']) ?>

                        <div class="form-group">
                            <?= Html::tag('label', 'Mitra', ['for' => 'partner_id']) ?>
                            <?= Html::dropDownList('partner_id', Yii::$app->request->post('partner_id'), ArrayHelper::map(Partner::find()->all(), 'id', 'name'), [
                                'class' => 'form-control select2', 
                                'id' => 'partner_id', 
                                'prompt' => '- Pilih Mitra -',
                            ]) ?>
                        </div>

                        <div class="form-group">
                            <?= Html::tag('label', 'Tanggal Mulai', ['for' => 'date_from']) ?>
                            <div class="input-group">
                                <?= Html::input('text', 'date_from', Yii::$app->request->post('date_from'), [
                                    'class' => 'form-control datepicker', 
                                    'id' => 'date_from',
                                    'autocomplete' => 'off',
                                ]) ?>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::tag('label', 'Tanggal Akhir', ['for' => 'date_until']) ?>
                            <div class="input-group">
                                <?= Html::input('text', 'date_until', Yii::$app->request->post('date_until'), [
                                    'class' => 'form-control datepicker', 
                                    'id' => 'date_until',
                                    'autocomplete' => 'off',
                                ]) ?>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>  

                        <div class="form-group">
                            <?= Html::submitButton('Export', ['class' => 'btn btn-success waves-effect waves-light']) ?>
                        </div>

                    <?= Html::endForm() ?>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->   
</div>