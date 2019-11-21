<?php
namespace backend\widgets\menu;

use yii\base\Widget;

class MenuWidget extends Widget{

    public $items;
    public $tab;
    public $count = false;

    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('index', [
            'items' => $this->items,
            'tab'	=> $this->tab,
        ]);
    }
}
?>
