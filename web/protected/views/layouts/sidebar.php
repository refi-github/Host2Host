<?php

use yii\helpers\Url;
use app\models\User;

?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!-- LOGO -->
        <div class="text-center mt-4">
            <a href="#" class="logo">
                <span>
                    <img src="<?= Url::base(); ?>/themes/highdmin/assets/images/logo-refi.png" alt="" height="35">
                </span>
            </a>
        </div>

        <!-- User box -->
        <div class="user-box text-center">
                <img src="<?= Url::base(); ?>/themes/highdmin/assets/images/users/avatar-default.png" alt="user-img" height="50" class="rounded-circle">
            <h5>
                <a href="#">
                <?php 
                if (isset(Yii::$app->user->identity->name)) 
                    : echo Yii::$app->user->identity->name; 
                endif ?>
                </a>
            </h5>
            <p class="text-muted">
                <?php 
                if (isset(Yii::$app->user->identity->username)) 
                    : echo Yii::$app->user->identity->username; 
                endif 
                ?>
            </p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="<?= Url::base(); ?>/">
                        <i class="icon-screen-desktop"></i> <span> Beranda </span>
                    </a>
                </li>

                <?php 
                if (isset(Yii::$app->user->identity->role) && (Yii::$app->user->identity->role == User::ROLE_ADMIN || Yii::$app->user->identity->role == User::ROLE_STAFF)) : 
                ?>
                    <li>
                        <a href="javascript: void(0);"><i class="icon-layers"></i> <span> Master </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?= Url::base(); ?>/legal-document">Dokumen Hukum</a></li>
                            <li><a href="<?= Url::base(); ?>/financial-performance">Kinerja Keuangan</a></li>
                            <li><a href="<?= Url::base(); ?>/business-scope">Ruang Lingkup Usaha</a></li>
                            <li><a href="<?= Url::base(); ?>/user">User</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?= Url::base(); ?>/partner">
                            <i class="icon-user"></i> <span> Mitra </span>
                        </a>
                    </li>
                <?php
                endif
                ?>

                <li>
                    <a href="javascript: void(0);"><i class="icon-book-open"></i> <span> Loan </span> <span class="menu-arrow"></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= Url::base(); ?>/debtor">Debtor</a></li>
                        <li><a href="<?= Url::base(); ?>/application">Application</a></li>
                        <li><a href="<?= Url::base(); ?>/disbursement">Disbursement</a></li>
                        <li><a href="<?= Url::base(); ?>/payment">Payment</a></li>
                        <li><a href="<?= Url::base(); ?>/aging">Aging</a></li>
                    </ul>
                </li>

                <?php 
                if (isset(Yii::$app->user->identity->role) && (Yii::$app->user->identity->role == User::ROLE_ADMIN || Yii::$app->user->identity->role == User::ROLE_STAFF)) :
                ?>
                    <li>
                        <a href="javascript: void(0);"><i class="icon-notebook"></i> <span> Report </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level nav" aria-expanded="false">
                            <li><a href="<?= Url::base(); ?>/report-disbursement">Disbursement</a></li>
                            <li><a href="<?= Url::base(); ?>/report-payment">Payment</a></li>
                            <li><a href="<?= Url::base(); ?>/report-aging">Aging</a></li>
                            <li><a href="<?= Url::base(); ?>/report-silaras">SILARAS</a></li>
                            <li><a href="javascript: void(0);" aria-expanded="false">SLIK <span class="menu-arrow"></span></a>
                                <ul class="nav-third-level nav" aria-expanded="false">
                                    <li><a href="<?= Url::base(); ?>/report-slik/d01">D01</a></li>
                                    <li><a href="<?= Url::base(); ?>/report-slik/d02">D02</a></li>
                                    <li><a href="<?= Url::base(); ?>/report-slik/f01">F01</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php
                endif
                ?>
            </ul>
        </div>
        <!-- Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->