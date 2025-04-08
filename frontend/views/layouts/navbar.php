<?php

use yii\helpers\Html;
use \yii\helpers\Url;
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link toggle-sidebar-button" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::to('/record/dashboard/index') ?>" class="nav-link">Don Eufemio F. Eriguel Memorial National High School</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div> -->
        </li>


        <li class="nav-item">
            <div class="row">
                <u class="nav-link  py-2 px-0"><?= Yii::$app->user->identity->username ?></u>
                <div>
                    <?= Html::a(
                        '<i class="fas fa-sign-out-alt"></i> <span class="ml-1">Logout</span>',
                        ['/site/logout'],
                        [
                            'data-method' => 'post',
                            'class' => 'nav-link',
                            'title' => 'Logout',
                        ]
                    ) ?>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->