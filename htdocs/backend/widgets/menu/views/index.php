<?php 
use yii\helpers\Url;

foreach ($items as $item) { ?>
	<?php if($tab == 'all') : ?>
		<div class="col-6 col-sm-4 col-md-3 col-lg-2">
		    <a href="<?= Url::to([$item['url'][0]]) ?>">
		    	<div class="menu-card-wrapper">
		    	    <div class="card menu-card">
		    	    	<?php if(isset($item['count']) && $item['count']) : ?>
		    	    		<span class="card-count"><?= $item['count'] ?></span>
		    	    	<?php endif; ?>
		    	        <div class="card-title">
		    	            <i class="fa fa-<?= $item['icon'] ?>" aria-hidden="true"></i>
		    	        </div>
		    	        <div class="card-content menu-card-content">
		    	            <div class="menu-card-link"><?= Yii::t('app', $item['label']) ?></div>
		    	        </div>
		    	    </div>
		    	</div>
		    </a>
		</div>
	<?php elseif($item['tab'] == $tab) : ?>
		<div class="col-6 col-sm-4 col-md-3 col-lg-2">
		    <a href="<?= Url::to([$item['url'][0]]) ?>">
		    	<div class="menu-card-wrapper">
		    	    <div class="card menu-card">
		    	    	<?php if(isset($item['count']) && $item['count']) : ?>
		    	    		<span class="card-count"><?= $item['count'] ?></span>
		    	    	<?php endif; ?>
		    	        <div class="card-title">
		    	            <i class="fa fa-<?= $item['icon'] ?>" aria-hidden="true"></i>
		    	        </div>
		    	        <div class="card-content menu-card-content">
		    	            <div class="menu-card-link"><?= Yii::t('app', $item['label']) ?></div>
		    	        </div>
		    	    </div>
		    	</div>
		    </a>
		</div>
	<?php endif; ?>
<?php } ?>
