<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Social Buttons assets
 * @author KM
 */
class SocialButtonsAsset extends AssetBundle
{
    public $basePath = '@webroot/plugins/social-buttons';
    public $baseUrl = '@web/plugins/social-buttons';

    public $css = [
        'bootstrap-social.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'fontAwesome',
    ];
}
