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
    </div>

    <div class="col-md-6">
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
</div>

<style>
    th {
        width: 60%;
    }
</style>