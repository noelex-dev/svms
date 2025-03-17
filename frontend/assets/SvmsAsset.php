<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class SvmsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/styles.css',
        'css/toastr.min.css',
    ];
    public $js = [
        'js/modal.js',
        'js/toastr.min.js',
    ];
}
