<?php 
use yii\helpers\Url;
?>
<ul id="left-menu">
	<?php foreach ($items as $item) { ?>
		<li>
			<a href="<?= Url::to([$item['url'][0]]) ?>">
				<?php if(isset($item['count']) && $item['count']) : ?>
					<span class="left-count">+ <?= $item['count'] ?></span>
				<?php endif; ?>
			    <div class="card-title">
			        <i class="fa fa-<?= $item['icon'] ?>" aria-hidden="true"></i>
			    </div>
			    <div class="card-content menu-card-content">
			        <div class="menu-card-link"><?= Yii::t('app', $item['label']) ?></div>
			    </div>
			</a>
		</li>
	<?php } ?>
</ul>

<style>
	#left-menu li a, #left-menu li .left-count { transition: all 0.3s; }
	#left-menu li a { text-decoration: none; display: flex; border-bottom: 1px solid }
	#left-menu li:hover a{ color: #323333 }
	#left-menu li { 
		position: relative;
		list-style: none;     
		margin: 5px 0px;
    	padding: 5px 0px;
    	font-size: 15px;
    }
	#left-menu li .card-title { width: 25px; }
	#left-menu li .left-count { 
		position: absolute;
	    right: 0px;
	    top: 3px;
	    color: #f00;
	    width: auto;
	    height: 21px;
	    font-size: 12px;
	    line-height: 20px;
	    padding: 0px 4px;
	    text-align: center;
	    border: 1px solid red;
	}
	#left-menu li:hover .left-count {
		background-color: red;
		color: white;
	}
</style>