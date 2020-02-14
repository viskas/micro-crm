<?php
use mdm\admin\components\Helper;
use mdm\admin\components\MenuHelper;
use backend\helpers\BadgeHelper;

$role = \backend\models\AuthAssignment::findOne(['user_id' => Yii::$app->user->identity->id]);

$is_manager = isset($role->item_name) && $role->item_name == 'Аналитик' ? true : false;

$callsBadge = BadgeHelper::callsCount();
$missedCallsBadge = BadgeHelper::missedCalls();

$calls = $callsBadge == 0 ? '' : '<span class="pull-right-container"><small class="label label-danger pull-right-new">'.$callsBadge.'</small></span>';
$missedCalls = $missedCallsBadge == 0 ? '' : '<span class="pull-right-container"><small class="label label-danger pull-right-new">'.$missedCallsBadge.'</small></span>';
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
                ['label' => 'Главная страница '.$missedCalls, 'icon' => 'dashboard', 'url' => ['/site/index']],
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
                $is_manager ? ['label' => 'Мои звонки '.$calls, 'icon' => 'phone', 'url' => ['/client-calls/index']] : [],
                ['label' => 'Звонки', 'icon' => 'phone', 'url' => ['/admin-client-calls/index']],
                ['label' => 'Записи звонков', 'icon' => 'file-audio-o', 'url' => ['/audio/index']],
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
