<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            <?php
                            if (!is_null($this->title)) {
                                echo \yii\helpers\Html::encode($this->title);
                            }
                            ?>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <?php if (isset($this->params['breadcrumbs'])): ?>
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
        <div class="content p-0">
            <?= $content ?>
        </div>
    </div>
<?php else: ?>
    <div class="content-wrapper">
        <div class="content p-0 m-0">
            <?= $content ?>
        </div>
    </div>
<?php endif; ?>