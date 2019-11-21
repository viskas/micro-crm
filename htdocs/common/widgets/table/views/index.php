<?php 
$user = common\models\User::find()
            ->joinWith(['userProfile'])
            ->where(['user.id' => Yii::$app->user->identity->getId()])
            ->one();
$balance = null;
if(isset($user->userProfile->utip_user_id)) 
    $balance = common\helpers\Utip::GetBalanceInfo($user->userProfile->utip_user_id, backend\helpers\MainHelper::UtipLogin());  
?>
<?php if ($balance['result'] = true || isset($balance['data']) || !empty($balance['data'])): ?>
    <?php if($type !== 'ajax') : ?>
    <div class="bill active">
    <?php endif; ?>
        <a id="icon-bill" class="icon-bill" href="#"><?= Yii::t('app', 'Список моих счетов') ?> <div class="bill-count"><?= isset($balance['data']) ? count($balance['data']) : 0 ?></div></a>
        <?php if(isset($balance['data'])): ?>
            <div class="bill-update">
                <button id="update-bills" class="button button-update">
                    <?= Yii::t('app', 'Обновить') ?>
                </button>
            </div>
            <table>
                <tr>
                    <th><?= Yii::t('app', 'НОМЕР СЧЁТА') ?></th>
                    <th><?= Yii::t('app', 'БАЛЛАНС') ?></th>
                </tr>

                <?php if(isset($balance['data'])) : ?>
                    <?php foreach ($balance['data'] as $data): ?>
                        <tr>
                            <td><?= $data['server_account'] ?></td>
                            <td>$ <?= $data['freeBalance'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        <?php else: ?>
            <div>
                <?= Yii::t('app', 'Счетов нет') ?>
            </div>
        <?php endif; ?>
    <?php if($type !== 'ajax') : ?>
    </div>
    <?php endif; ?>
<?php endif; ?>