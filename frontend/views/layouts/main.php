<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\SvmsAsset;

SvmsAsset::register($this);

use yii\helpers\Json;

$flashes = Yii::$app->session->getAllFlashes();
if (!empty($flashes)) {
    $js = [];
    foreach ($flashes as $type => $message) {
        $js[] = "toastr.{$type}(" . Json::encode($message) . ");";
    }
    $this->registerJs(implode("\n", $js));
}

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1] . '/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php $this->registerCsrfMetaTags() ?>
    <title="<?= Html::encode($this->title) ?>< /title>
        <?php $this->head() ?>
        <?php if (Yii::$app->user->isGuest): ?>
            <style>
                .content-wrapper {
                    margin-left: 0 !important;
                    background-color: #F4F6F9 !important;
                }

                .breadcrumb {
                    display: none;
                }
            </style>
        <?php endif; ?>
</head>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
            <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>
        <?php endif; ?>

        <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= $this->render('control-sidebar') ?>
            <?= $this->render('footer') ?>
        <?php endif; ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>