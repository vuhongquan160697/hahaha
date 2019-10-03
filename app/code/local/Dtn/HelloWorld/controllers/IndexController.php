<?php
class Dtn_HelloWorld_IndexController extends Mage_Core_Controller_Front_Action
{
    function indexAction(){

//        echo 'Helloworld';
        $this->loadLayout();
        $this->renderLayout();
    }
    function sayhiAction(){
        echo 'say hi!!!!';
    }
//    hàm gọi đến cái layout, template. giao diện front_end
    function googlebyeAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
}