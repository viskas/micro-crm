<?php 
namespace common\widgets\verification;

use Yii;
use \yii\bootstrap\Widget;

use common\models\Notifications;
use common\models\UserProfile;
use common\models\Document;

class Verification extends Widget
{
	public function run() 
	{
		return $this->render('index',[
			'status' => $this->getStatus()
		]);
	}

	protected function getStatus()
	{
		$model = Document::find()
				->select('COUNT(id) as photo_passport')
				->where(['user_id' => Yii::$app->user->identity->id])
				->andWhere(['!=', 'status', '1'])
				->one();
		if(!$model ||($model && $model->photo_passport == 0)) {
			$profile 				= UserProfile::findOne(['user_id' => Yii::$app->user->identity->id]);
			$profile->verification 	= 1;
			if($profile->save(false)) {
				$noty 			= new Notifications();
				$noty->title 	= Yii::t('app', 'Ваш аккаунт успешно верифицирован!');
				$noty->type 	= 'system';
				$noty->user_id	= Yii::$app->user->identity->id;
				$noty->save(false);
				return true;
			}
		}
		return false;
	}
} 

?>