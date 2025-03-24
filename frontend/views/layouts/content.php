<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php
                        if (!Yii::$app->user->isGuest) { // Check if user is logged in
                            if (!is_null($this->title)) {
                                echo \yii\helpers\Html::encode($this->title);
                            } else {
                                echo \yii\helpers\Inflector::camelize($this->context->id);
                            }
                        }
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <?php if (!Yii::$app->user->isGuest && isset($this->params['breadcrumbs'])): ?>
                        <?php
                        echo Breadcrumbs::widget([
                            'links' => $this->params['breadcrumbs'],
                            'options' => [
                                'class' => 'breadcrumb float-sm-right'
                            ]
                        ]);
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <?= $content ?>
    </div>
</div>

<?php if (Yii::$app->user->isGuest): ?>
    <style>
        .content-wrapper {
            margin-left: 0 !important;
            background-color: #F4F6F9 !important;
        }
    </style>
<?php endif; ?>