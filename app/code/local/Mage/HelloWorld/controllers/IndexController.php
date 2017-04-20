<?php
class Mage_HelloWorld_IndexController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){
        $this->loadLayout();
        
        return $this->renderLayout();
    }
    
    public function addAction(){
        echo 'Foo add Action';
    }

}
