<?php


class Dtn_Weblog_Block_Test extends Mage_Core_Block_Template
{


    public function view()
    {
        $data = Mage::getModel('weblog/blogpost')->getCollection();
        return $data;
    }
}