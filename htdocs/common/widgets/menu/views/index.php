<div class="menu_all">
    <div class="grid">
        <ul class="menu">
            <li class="<?= $tab == 'main' ? 'active' : '' ?>">
                <a href="/"><?= Yii::t('app', 'Главная') ?></a>
            </li>
            <li class="<?= $tab == 'crypto' || $tab == 'commodities' || $tab == 'resources' || $tab == 'metals' || $tab == 'promotions' || $tab == 'currency' || $tab == 'indexes' || $tab == 'cdf' || $tab == 'unique' ? 'active' : '' ?> submenu_arrow">
                <a href="#"><?= Yii::t('app', 'Торговые активы') ?></a>
                <ul class="submenu">
                    <li class="<?= $tab == 'currency' ? 'active' : '' ?>">
                        <a href="/assets/currency" class="icon-dollar"><?= Yii::t('app', 'Валюта') ?></a>
                    </li>
                    <li class="<?= $tab == 'promotions' ? 'active' : '' ?>">
                        <a href="/assets/promotions" class="icon-akcii"><?= Yii::t('app', 'Акции') ?></a>
                    </li>
                    <li class="<?= $tab == 'indexes' ? 'active' : '' ?>">
                        <a href="/assets/indexes" class="icon-levels"><?= Yii::t('app', 'Индексы') ?></a>
                    </li>
                    <li class="<?= $tab == 'futures' ? 'active' : '' ?>">
                        <a href="/assets/futures" class="icon-bar-chart"><?= Yii::t('app', 'Фьючерсы') ?></a>
                    </li>
                    <li class="<?= $tab == 'commodities' ? 'active' : '' ?>">
                        <a href="/assets/commodities" class="icon-shopping-cart"><?= Yii::t('app', 'Сырьевые товары') ?></a>
                    </li>
                    <li class="<?= $tab == 'metals' ? 'active' : '' ?>">
                        <a href="/assets/metals" class="icon-diamond"><?= Yii::t('app', 'Драгоценные металлы') ?></a>
                    </li>
                    <li class="<?= $tab == 'resources' ? 'active' : '' ?>">
                        <a href="/assets/resources" class="icon-thunderbolt"><?= Yii::t('app', 'Энергоресурсы') ?></a>
                    </li>
                    <li class="<?= $tab == 'crypto' ? 'active' : '' ?>">
                        <a href="/assets/crypto" class="icon-bitcoin"><?= Yii::t('app', 'Криптовалюта') ?></a>
                    </li>
                    <li class="<?= $tab == 'unique' ? 'active' : '' ?>">
                        <a href="/assets/unique" class="icon-idea"><?= Yii::t('app', 'Уникальные разработки') ?></a>
                    </li>
                    <li class="<?= $tab == 'cdf' ? 'active' : '' ?>">
                        <a class="icon-cdfs" href="/assets/cfd"><?= Yii::t('app', 'CFD') ?></a>
                    </li>
                </ul>
            </li>
            <li class="<?= $tab == 'partners' ? 'active' : '' ?>">
                <a href="/assets/partners"><?= Yii::t('app', 'Партнёрская программа') ?></a>
            </li>
            <li class="submenu_arrow <?= $tab == 'bills' || $tab == 'portfolio' ? 'active' : '' ?>">
                <a href="#"><?= Yii::t('app', 'Счета') ?></a>
                <ul class="submenu">
                    <li class="<?= $tab == 'bills' ? 'active' : '' ?>">
                        <a href="/assets/bills" class="icon-type-of-account"><?= Yii::t('app', 'Типы счетов') ?></a>
                    </li>
                    <li class="<?= $tab == 'portfolio' ? 'active' : '' ?>">
                        <a href="/assets/portfolio" class="icon-case"><?= Yii::t('app', 'Портфельное инвестирование') ?></a>
                    </li>
                </ul>
            </li>
            <li class="<?= $tab == 'news' ? 'active' : '' ?>">
                <a href="/news/all"><?= Yii::t('app', 'Новости') ?></a>
            </li>
            <li class="<?= $tab == 'contact' ? 'active' : '' ?>">
                <a href="/contact"><?= Yii::t('app', 'Контакты') ?></a>
            </li>
            <li class="<?= $tab == 'about' ? 'active' : '' ?>">
                <a href="/about"><?= Yii::t('app', 'О нас') ?></a>
            </li>
            </li>
        </ul>
    </div>
</div>