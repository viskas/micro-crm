<?php
namespace backend\widgets\menu;

use yii\base\Widget;

class LeftMenuWidget extends Widget{

    public $items;
    public $count = false;

    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('left', [
            'items' => $this->items,
        ]);
    }
}
?>
