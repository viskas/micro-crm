<?php
use mdm\admin\components\Helper;
use mdm\admin\components\MenuHelper;

$role = \backend\models\AuthAssignment::findOne(['user_id' => Yii::$app->user->identity->id]);

$is_manager = isset($role->item_name) && $role->item_name == 'Менеджер' ? true : false;
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->email ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?php
            $menuItems = [
                ['label' => 'Главная страница', 'icon' => 'dashboard', 'url' => ['/site/index']],
                [
                    'label' => 'Пользователи',
                    'icon' => 'user-o',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Пользователи', 'icon' => 'user-circle', 'url' => ['/personal/index']],
//                        ['label' => 'Персонал', 'icon' => 'address-book', 'url' => ['/personal/index']],
                        ['label' => 'Распределение прав', 'icon' => 'superpowers', 'url' => ['/admin/role']],
                    ],
                ],
                $is_manager ? ['label' => 'Мои клиенты', 'icon' => 'id-card-o', 'url' => ['/client/index']] : [],
                ['label' => 'Клиенты', 'icon' => 'id-card-o', 'url' => ['/admin-client/index']],
                $is_manager ? ['label' => 'Мои звонки', 'icon' => 'phone', 'url' => ['/client-calls/index']] : [],
                ['label' => 'Звонки', 'icon' => 'phone', 'url' => ['/admin-client-calls/index']],
            ];

            $menuItems = Helper::filter($menuItems);
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'encodeLabels' => false,
                'items' => $menuItems
            ]
        ) ?>

    </section>
</aside>
