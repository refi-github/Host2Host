<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Url::base(); ?>/themes/highdmin/assets/images/favicon.png"/>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Begin Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?= $this->render('sidebar.php'); ?>

    <!-- Start right Content here -->
    <div class="content-page">

        <!-- Topbar -->
        <?= $this->render('topbar.php'); ?>

        <!-- Start Page content -->
        <div class="content">
            <div class="container-fluid">
                <?= $content; ?>
            </div>
        </div> 
        <!-- content -->

        <!-- Footer -->
        <footer class="footer text-right">
            <?= date("Y"); ?> © <?= Yii::$app->name; ?>
        </footer>

    </div> 
    <!-- End Right content here -->

</div>
<!-- End Wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
