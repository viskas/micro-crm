<?php 
namespace common\widgets\table;

use Yii;
use yii\bootstrap\Widget;


class Table extends Widget {

	public $type;

	public function run() {
		return $this->render('index', [
			'type' => $this->type
		]);
	}
}
?>