<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/highdmin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
        'themes/highdmin/plugins/bootstrap-select/css/bootstrap-select.min.css',
        'themes/highdmin/plugins/select2/css/select2.min.css',
        'themes/highdmin/assets/css/bootstrap.min.css',
        'themes/highdmin/assets/css/icons.css',
        'themes/highdmin/assets/css/metismenu.min.css',
        'themes/highdmin/assets/css/style.css',
    ];
    public $js = [
        'themes/highdmin/assets/js/modernizer.min.js',
        'themes/highdmin/assets/js/bootstrap.bundle.min.js',
        'themes/highdmin/assets/js/metisMenu.min.js',
        'themes/highdmin/assets/js/jquery.slimscroll.js',
        'themes/highdmin/plugins/moment/moment.js',
        'themes/highdmin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        'themes/highdmin/plugins/select2/js/select2.min.js',
        'themes/highdmin/plugins/bootstrap-select/js/bootstrap-select.js',
        'themes/highdmin/assets/pages/jquery.form-pickers.init.js',
        'themes/highdmin/assets/pages/jquery.form-advanced.init.js',
        'themes/highdmin/assets/js/jquery.core.js',
        'themes/highdmin/assets/js/jquery.app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
