<?php

class Dtn_Weblog_Block_Adminhtml_Blogpost_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_blogpost';
        $this->_blockGroup = 'weblog';//Không được trùng tên blockgroup trước
        $this->_updateButton('save', 'label', Mage::helper('weblog')->__('Saveeee'));
        $this->_updateButton('delete', 'label', Mage::helper('weblog')->__('Delete'));
    }
    public function getHeaderText()
    {
        return Mage::helper('weblog')->__('My blogpost container');
    }

}
/**
 *
 */
