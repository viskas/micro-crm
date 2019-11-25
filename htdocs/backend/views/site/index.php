<?php
use yii\helpers\Url;

$this->title = 'Главная страница';

$now = new DateTime;
$now->setTime( 0, 0, 0 );
?>


<?php if (isset($calls) && !empty($calls)): ?>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <i class="fa fa-bullhorn"></i>
                    <h3 class="box-title">Звонки на сегодня</h3>
                </div>
                <div class="box-body">
                    <?php foreach ($calls as $call): ?>
                        <?php
                            $callDate = new DateTime($call->date);
                            $callDate->setTime( 0, 0, 0 );

                            $date = strtotime($call->date . ' ' . $call->time .':00');
                            $nowDate = time();
                        ?>

                        <?php if ($now->diff($callDate)->days === 0 && !($date <= $nowDate)): ?>
                            <div id="call-<?= $call->id ?>" class="callout callout-warning">
                                <h4>
                                    Звонок <?= date('d.m.Y', strtotime($call->date)) ?> в <?= $call->time ?>
                                    <input type="checkbox" class="pull-right main-call-complete" value="<?= $call->id ?>">
                                </h4>
                                <p>
                                    <b>Клиент:</b> <a href="<?= Url::to(['client/index', 'ClientsSearch[id]' => $call->client->id]) ?>"><?= $call->client->first_name ?> <?= isset($call->client->last_name) ? $call->client->last_name :'' ?></a><br>
                                    <b>Платформа:</b> <?= isset($call->client->platform) ? $call->client->platform : '' ?><br>
                                    <b>Телефон:</b> <?= isset($call->client->phone_number) ? $call->client->phone_number : '' ?><br>
                                    <b>Доп. телефон:</b> <?= isset($call->client->additional_phone_number) ? $call->client->additional_phone_number : '' ?><br>
                                    <b>Заметка:</b> <?= $call->comment ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <i class="fa fa-ban"></i>
                    <h3 class="box-title">Пропущенные звонки</h3>
                </div>
                <div class="box-body">
                    <?php foreach ($calls as $call): ?>
                        <?php
                        $callDate = new DateTime($call->date);
                        $callDate->setTime( 0, 0, 0 );

                        $date = strtotime($call->date . ' ' . $call->time .':00');
                        $nowDate = time();
                        ?>

                        <?php if ($now->diff($callDate)->days !== 0 || $date <= $nowDate): ?>
                            <div id="call-<?= $call->id ?>" class="callout callout-danger">
                                <h4>
                                    Звонок <?= date('d.m.Y', strtotime($call->date)) ?> в <?= $call->time ?>
                                    <input type="checkbox" class="pull-right main-call-complete" value="<?= $call->id ?>">
                                </h4>
                                <p>
                                    <b>Клиент:</b> <a href="<?= Url::to(['client/index', 'ClientsSearch[id]' => $call->client->id]) ?>"><?= $call->client->first_name ?> <?= isset($call->client->last_name) ? $call->client->last_name :'' ?></a><br>
                                    <b>Платформа:</b> <?= isset($call->client->platform) ? $call->client->platform : '' ?><br>
                                    <b>Телефон:</b> <?= isset($call->client->phone_number) ? $call->client->phone_number : '' ?><br>
                                    <b>Доп. телефон:</b> <?= isset($call->client->additional_phone_number) ? $call->client->additional_phone_number : '' ?><br>
                                    <b>Заметка:</b> <?= $call->comment ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php if(isset($futureCalls) && !empty($futureCalls)): ?>
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-info"></i>
                        <h3 class="box-title">Запланированные звонки</h3>
                    </div>
                    <div class="box-body">
                        <?php foreach ($futureCalls as $call): ?>
                            <div id="call-<?= $call->id ?>" class="callout callout-info">
                                <h4>
                                    Звонок <?= date('d.m.Y', strtotime($call->date)) ?> в <?= $call->time ?>
                                    <input type="checkbox" class="pull-right main-call-complete" value="<?= $call->id ?>">
                                </h4>
                                <p>
                                    <b>Клиент:</b> <a href="<?= Url::to(['client/index', 'ClientsSearch[id]' => $call->client->id]) ?>"><?= $call->client->first_name ?> <?= isset($call->client->last_name) ? $call->client->last_name :'' ?></a><br>
                                    <b>Платформа:</b> <?= isset($call->client->platform) ? $call->client->platform : '' ?><br>
                                    <b>Телефон:</b> <?= isset($call->client->phone_number) ? $call->client->phone_number : '' ?><br>
                                    <b>Доп. телефон:</b> <?= isset($call->client->additional_phone_number) ? $call->client->additional_phone_number : '' ?><br>
                                    <b>Заметка:</b> <?= $call->comment ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
