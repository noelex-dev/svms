<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class SvmsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/styles.css',
    ];
    public $js = [
        'js/modal.js',
    ];
}
