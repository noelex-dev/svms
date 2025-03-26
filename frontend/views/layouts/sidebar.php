<?php

use yii\helpers\Url;


$roles = !Yii::$app->user->isGuest ? Yii::$app->authManager->getRolesByUser(Yii::$app->user->id) : [];
$isAdmin = isset($roles['Administrator']);
?>

<aside class="main-sidebar sidebar-dark-maroon elevation-4">
    <!-- Background Image -->
    <div class="sidebar-wrapper">
        <div class="d-flex justify-content-center align-items-center">
            <a href="<?= Url::base() ?>" class="d-flex justify-content-center align-items-center">
                <!-- @web/Logo.jpg DEFEMNHS -->
                <img src=" <?= Url::to('@web/Logo.jpg') ?>" alt="DEFEMNHS Logo" class="brand-image img-circle elevation-3" style="display: block; width: 70%; height: auto;">
            </a>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    // [
                    //     'template' => '<div class="dropdown-divider p-0 b-0"></div>',
                    //     'visible' => $isAdmin,
                    // ],
                    [
                        'label' => 'Dashboard',
                        'url' => '/record/dashboard/index',
                        'icon' => 'fas fa-chart-line',
                        'visible' => $isAdmin,
                    ],
                    // [
                    //     'template' => '<div class="dropdown-divider p-0 b-0"></div>',
                    //     'visible' => $isAdmin,
                    // ],
                    [
                        'label' => 'Content Management',
                        'icon' => 'fas fa-cogs',
                        'visible' => $isAdmin,
                        'items' => [
                            [
                                'label' => 'Semester',
                                'url' => ['/cms/semester/index'],
                                'icon' => 'fas fa-calendar-week'
                            ],
                            [
                                'label' => 'School Year',
                                'url' => ['/cms/school-year/index'],
                                'iconStyle' => 'far',
                                'icon' => 'fas fa-calendar-alt'
                            ],
                            [
                                'label' => 'Activate SY-Sem',
                                'url' => ['/cms/active-school-year-sem/index'],
                                'iconStyle' => 'far',
                                'icon' => 'fas fa-calendar-check'
                            ],
                            [
                                'label' => 'Grade Level',
                                'url' => ['/cms/grade-level/index'],
                                'icon' => 'fas fa-layer-group'
                            ],
                            [
                                'label' => 'Strand',
                                'url' => ['/cms/strand/index'],
                                'icon' => 'fas fa-sitemap'
                            ],
                            [
                                'label' => 'Section',
                                'url' => ['/cms/section/index'],
                                'icon' => 'fas fa-users-viewfinder'
                            ],
                            [
                                'label' => 'Relationship Type',
                                'url' => ['/cms/relationship/index'],
                                'icon' => 'fas fa-people-arrows'
                            ],
                            [
                                'label' => 'Violation',
                                'url' => ['/cms/violation/index'],
                                'icon' => 'fas fa-exclamation-triangle'
                            ],

                        ],
                        'active' => true,
                        'expanded' => true,
                    ],
                    // [
                    //     'template' => '<div class="dropdown-divider"></div>',
                    //     'visible' => $isAdmin,
                    // ],
                    [
                        'label' => 'Records',
                        'icon' => 'fas fa-laptop',
                        'visible' => $isAdmin,
                        'items' => [
                            [
                                'label' => 'Students',
                                'url' => ['/record/student-data/index'],
                                'icon' => 'fas fa-user-graduate'
                            ],
                            [
                                'label' => 'Student Violation',
                                'url' => ['/record/student-violation/index'],
                                'icon' => 'fas fa-user-times'
                            ],
                            [
                                'label' => 'Teacher Advisory',
                                'url' => ['/record/teacher-advisory-assignment/index'],
                                'icon' => 'fas fa-chalkboard-teacher'
                            ],
                        ],
                        'active' => true,
                        'expanded' => true,
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>