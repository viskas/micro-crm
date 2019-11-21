<?php 
namespace common\widgets\noty;

use Yii;
use yii\bootstrap\Widget;

use common\models\Notifications;

class Noty extends Widget {

	public $type;

	public function run() {
		return $this->render('index', [
			'notifications'	=> $this->getQuery(),
			'type'			=> $this->type,
		]);
	}

	protected function getQuery() {
		if(!Yii::$app->user->isGuest) {
			return Notifications::findAll(['user_id' => Yii::$app->user->identity->id]);
		}
		return false;
	}
}
?>