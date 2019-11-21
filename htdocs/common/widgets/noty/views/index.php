<?php if($type !== 'ajax') : ?>
<div id="notice" class="notice">
<?php endif; ?>
    <div id="icon-alarm" class="img icon-alarm"><span><?= isset($notifications[0]) ? count($notifications) : 0 ?></span> </div>
    <div class="menu_up">
    	<?php if($notifications) : ?>
    		<ul>
                <li class="all">
                    <div class="checkbox">
                        <input type="checkbox" id="checkbox_all" name="" />
                        <label for="checkbox_all"></label>
                    </div>
                    Уведомления
                    <a href="#" id="delete_all" class="icon-delete"></a>
                </li>
    			<?php foreach ($notifications as $item) : ?>
    				<li class="label-noty <?= $item->status == '1' ? 'new' : '' ?>" data-id="<?= $item->id ?>">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox_<?= $item->id ?>" name="noty[]" value="<?= $item->id ?>" />
                            <label for="checkbox_<?= $item->id ?>"></label>
                        </div>
                        <a href="#" class="noty-read" data-id="<?= $item->id ?>"><?= $item->title ?></a>
                    </li>
    			<?php endforeach; ?>
    		</ul>
    	<?php endif; ?>
    </div>

    <?= $this->registerJs("
        $(document).on('click', 'li.label-noty', function () {
            var id = $(this).data('id');
            var checkbox = $('#checkbox_'+id);

            if (checkbox.is(':checked')) {
                checkbox.prop('checked', false);
            } else {
                checkbox.prop('checked', true);
            }

            return false;
        });
    ") ?>
<?php if($type !== 'ajax') : ?>
</div>
<?php endif; ?>