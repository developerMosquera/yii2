<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel" >
            <div class="pull-left">
                <button type="button" class="btn btn-default btn-lg" style="width: 50px; height: 50px; padding: 6px 0px; border-radius: 50%; text-align: center; font-size: 12px; line-height: 1.42857;">
                  <span class="glyphicon glyphicon-user" aria-hidden="true" style="font-size: 2em;"></span>
                </button>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menú', 'options' => ['class' => 'header', 'id' => 'menuLeftApp']],
                    [
                        'label' => yii::t('app', 'Access'),
                        'icon' => 'globe',
                        'url' => '#',
                        'options' => ['id' => 'accessApp'],
                        'visible' => (isset(Yii::$app->session['userMenu']['access'])) ? true : false,
                        'items' => [
                            [
                                'label' => yii::t('app', 'Roles'),
                                'icon' => 'user',
                                'url' => ['/roles/roles'],
                                'visible' => (isset(Yii::$app->session['userMenu']['roles'])) ? true : false,
                            ],
                            [
                                'label' => yii::t('app', 'Operations'),
                                'icon' => 'wrench',
                                'url' => ['/operaciones/operaciones'],
                                'visible' => (isset(Yii::$app->session['userMenu']['operaciones'])) ? true : false,
                            ],
                        ]
                    ],
                    ['label' => yii::t('app', 'Users'), 'icon' => 'users', 'url' => ['/users/users'], 'options' => ['id' => 'usersApp'], 'visible' => (isset(Yii::$app->session['userMenu']['users'])) ? true : false,],
                    ['label' => 'Tour', 'icon' => 'plane', 'url' => '#', 'options' => ['id' => 'initTour']],

                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
