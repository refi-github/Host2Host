<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<!-- Top Bar Start -->
<div class="topbar">
    <nav class="navbar-custom">   
        <ul class="list-unstyled topbar-right-menu float-right mb-0">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="<?= Url::base(); ?>/themes/highdmin/assets/images/users/avatar-default.png" alt="user" class="rounded-circle"> <span class="ml-1">
                        <?php 
                        if (isset(Yii::$app->user->identity->name)) 
                            : echo Yii::$app->user->identity->name; 
                        endif 
                        ?> 
                        <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <?= Html::beginForm(['/site/logout'], 'post'); ?>
                        <button type="button" class="dropdown-item notify-item" onclick="submit()">
                            <i class="fi-power"></i> <span>Logout</span>
                        </button>
                    <?= Html::endForm()?>
                </div>
            </li>
        </ul>  
    </nav>
</div>
<!-- Top Bar End -->