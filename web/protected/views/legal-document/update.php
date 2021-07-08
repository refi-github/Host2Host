<?php

use yii\helpers\Html;

$pageName = 'Ubah Dokumen Hukum';
$this->title = $pageName . ' - ' . Yii::$app->name;
?>
<div class="legal-document-update">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><?= $pageName; ?></h4>
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
