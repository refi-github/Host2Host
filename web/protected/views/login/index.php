<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login - ' . Yii::$app->name;
?>

<style>
    .accountbg {
        background: url('<?= Url::base(); ?>/themes/highdmin/assets/images/bg-refi.jpg');
        background-size: cover;
        background-position: center;
    }
</style>

<!-- Begin page -->
<div class="accountbg"></div>

<div class="wrapper-page account-page-full">
    <div class="card">
        <div class="card-block">
            <div class="account-box">
                <div class="card-box p-5">
                    <h2 class="text-uppercase text-center mt-5 mb-5">
                        <a href="#" class="text-success">
                            <span><img src="<?= Url::base(); ?>/themes/highdmin/assets/images/logo-refi.png" alt="" height="85"></span>
                        </a>
                    </h2>

                    <?php 
                    if (Yii::$app->session->hasFlash('alert')) 
                        : echo Yii::$app->session->getFlash('alert'); 
                    endif 
                    ?>

                    <?= Html::beginForm(['index'], 'post', ['enctype' => 'multipart/form-data']) ?>

                        <div class="form-group m-b-20 row">
                            <div class="col-12">
                                <label for="username">Username</label>
                                <?= Html::activeInput('text', $model, 'username', ['class' => 'form-control', 'placeholder' => 'Masukkan username']) ?>
                                <?= Html::error($model, 'username'); ?>
                            </div>
                        </div>

                        <div class="form-group m-b-20 row">
                            <div class="col-12">
                                <label for="username">Password</label>
                                <?= Html::activeInput('password', $model, 'password', ['class' => 'form-control', 'placeholder' => 'Masukkan password']) ?>
                                <?= Html::error($model, 'password'); ?>
                            </div>
                        </div>

                        <div class="form-group row text-center m-t-10">
                            <div class="col-12">                                
                                <?= Html::submitButton('Login', ['class' => 'btn btn-block btn-primary waves-effect waves-light', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                        
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="m-t-40 text-center">
        <p class="account-copyright"><?= date("Y"); ?> © <?= Yii::$app->name; ?></p>
    </div>
</div>