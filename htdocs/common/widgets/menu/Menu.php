<?php 
namespace common\widgets\menu;

use yii\bootstrap\Widget;

Class Menu extends Widget {

	public $tab;

	public function run() 
	{
		return $this->render('index', [
			'tab' => $this->tab,
		]);
	}

} 
?>