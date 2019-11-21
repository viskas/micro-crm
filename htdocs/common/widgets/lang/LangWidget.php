<?php
namespace common\widgets\lang;

use yii\base\Widget;
use yii\caching\TagDependency;

class LangWidget extends Widget
{
    public $tmp;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('index');
    }

    protected function Query()
    {

    }
}