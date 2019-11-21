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
                'registerButtonsCss' => true
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
    </section>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y') ?>
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>