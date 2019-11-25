<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<div class="content-wrapper">
    <section id="request-content" class="content">
        <?= \backend\widgets\WrapperWidget::widget([
            'layerClass' => 'lo\modules\noty\layers\Noty',
            'layerOptions'=>[
                // for every layer (by default)
                'layerId' => 'noty-layer',
                'customTitleDelimiter' => '|',
                'overrideSystemConfirm' => true,
                'showTitle' => false,

                // for custom layer
                'registerAnimateCss' => true,
                'registerButtonsCss' => false
            ],

            // clientOptions
            'options' => [
                'dismissQueue' => true,
                'layout' => 'bottomRight',
                'timeout' => 2000,
                'theme' => 'relax',
                'progressBar' => true
            ],
        ]); ?>
        <?= $content ?>
        <button id="danger-modal" type="button" data-toggle="modal" data-target="#modal-danger" style="display: none"></button>
        <div class="modal modal-danger fade" id="modal-danger" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Звонок</h4>
                    </div>
                    <div class="modal-body">
                        <p>Напоминание о звонке!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Закрыть</button>
                        <a href="/admin" class="btn btn-outline">Перейти к звонку</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y') ?>
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>