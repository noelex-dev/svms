<?php
?>

<aside class="main-sidebar sidebar-dark-maroon elevation-4">
    <a href="/" class="brand-link">
        <img src="<?= yii\helpers\Url::to('@web/Logo.jpg') ?>" alt="DEFEMNHS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DEFEMNHS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="" class="img-circle elevation-2" alt="image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            use yii\helpers\Url;

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'url' => '#',
                        'icon' => 'fas fa-chart-line',
                    ],
                    ['template' => '<div class="dropdown-divider p-0 b-0"></div>'],
                    [
                        'label' => 'Content Management',
                        'icon' => 'fas fa-cogs',
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

                        ]
                    ],
                    ['template' => '<div class="dropdown-divider"></div>'],
                    [
                        'label' => 'Records',
                        'icon' => 'fas fa-laptop',
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
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>