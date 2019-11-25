<?php
use yii\widgets\DetailView;

$this->title = 'Карточка пользователя';
?>

<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Карточка плиента</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>

            <div class="box-body no-padding">
                <table class="table table-condensed table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td><?= $model->id ?></td>
                    </tr>
                    <tr>
                        <th>Платформа</th>
                        <td><?= $model->platform ?></td>
                    </tr>
                    <tr>
                        <th>Имя</th>
                        <td><?= $model->first_name ?></td>
                    </tr>
                    <tr>
                        <th>Фамилия</th>
                        <td><?= $model->last_name ?></td>
                    </tr>
                    <tr>
                        <th>Отчество</th>
                        <td><?= $model->patronymic ?></td>
                    </tr>
                    <tr>
                        <th>Номер счета</th>
                        <td><?= $model->account_number ?></td>
                    </tr>
                    <tr>
                        <th>Номер телефона</th>
                        <td><?= $model->phone_number ?></td>
                    </tr>
                    <tr>
                        <th>Дополнительный<br> номер телефона</th>
                        <td><?= $model->additional_phone_number ?></td>
                    </tr>
                    <tr>
                        <th>Дата рождения</th>
                        <td><?= $model->birthday ? date('m.d.Y', strtotime($model->birthday)) : '' ?></td>
                    </tr>
                    <tr>
                        <th>Адрес</th>
                        <td><?= $model->address ?></td>
                    </tr>
                    <tr>
                        <th>Skype</th>
                        <td><?= $model->skype ?></td>
                    </tr>
                    <tr>
                        <th>TeamViewer</th>
                        <td><?= $model->team_viewer ?></td>
                    </tr>
                    <tr>
                        <th>Верифицирован</th>
                        <td><?= $model->is_verified ? 'Да' : 'Нет' ?></td>
                    </tr>
                    <tr>
                        <th>Статус</th>
                        <td><?= $model->status ?></td>
                    </tr>
                    <tr>
                        <th>Дата создания</th>
                        <td><?= date('d.m.d H:i:s', strtotime($model->created_at)) ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Дополнительная информация</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $model->additional_info ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Перезвоны</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php if(isset($calls) && !empty($calls)): ?>
                    <?php foreach ($calls as $call): ?>
                        <strong class="text-<?= $call->status == 1 ? 'green' : 'red' ?>">
                            <i class="fa fa-phone margin-r-5"></i>
                            <span class="">
                                Позвонить <?= date('d.m.Y', strtotime($call->date)) ?> в <?= $call->time ?>
                            </span>
                        </strong>

                        <p class="text-muted" style="margin-top: 10px">
                        <div class="checkbox">
                            <label>
                                <?= $call->comment ?>
                            </label>
                        </div>
                        </p>

                        <hr>
                    <?php endforeach; ?>
                <?php else: ?>
                    Нету запланированых звонков
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Комментарии</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($comments) && !empty($comments)): ?>
                            <div class="tab-pane active" id="timeline">
                                <ul class="timeline timeline-inverse">
                                    <?php foreach ($comments as $comment): ?>
                                        <li>
                                            <i class="fa fa-comments bg-yellow"></i>
                                            <div class="timeline-item">
                                                <span class="time">
                                                    <i class="fa fa-clock-o"></i>
                                                    <?= date('d.m.Y H:i', strtotime($comment->created_at)) ?>
                                                </span>
                                                <h3 class="timeline-header no-border">
                                                    <?= $comment->comment ?>
                                                </h3>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            Комментарии отсутствуют.
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    th {
        width: 60%;
    }
</style>