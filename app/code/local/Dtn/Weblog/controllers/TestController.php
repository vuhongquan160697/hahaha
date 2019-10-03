<?php
class Dtn_Weblog_TestController extends Mage_Core_Controller_Front_Action{
    public function testAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
}