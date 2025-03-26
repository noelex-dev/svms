<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$error_arr = [
    '404' => Html::img('@web/images/error/404.png', ['alt' => 'error img', 'class' => 'img-fluid']),
    '403' => Html::img('@web/images/error/403.png', ['alt' => 'error img', 'class' => 'img-fluid'])
];
$exception = $name;
$error = NULL;
preg_match('/\d+/', $exception, $matches);
$error_code = $matches[0] ?? null;

if (!empty($error_code)) {
    $error = ArrayHelper::keyExists($error_code, $error_arr) ? $error_arr[$error_code] : NULL;
}
?>
<!-- auth-page wrapper -->
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="text-center">

                        <div class="mt-3">
                            <?= $error ?>
                            <h3 class="text-uppercase"><?= nl2br(Html::encode($message)) ?></h3>
                            <p class="text-muted mb-2">The above error occurred while the Web server was processing your request.</p>
                            <p class="text-muted mb-4">Please contact us if you think this is a server error. Thank you.</p>
                            <a href="/" class="btn btn-primary"><i class="mdi mdi-home me-1"></i>Back to home</a>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth-page content -->
</div>
<!-- end auth-page-wrapper -->