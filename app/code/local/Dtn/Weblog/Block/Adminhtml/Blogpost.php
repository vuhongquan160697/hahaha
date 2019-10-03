<?php
class Dtn_Weblog_Block_Adminhtml_Blogpost extends Mage_Adminhtml_Block_Widget_Grid_Container{
    public function __construct()
    {
        $this->_controller = 'adminhtml_blogpost';// trùng với tên controller
        $this->_blockGroup = 'weblog'; // Tên module
        $this->_headerText = Mage::helper('weblog')->__('Blogpost Magener'); // name là tên module
        $this->_addButtonLabel = Mage::helper('weblog')->__('Add Blogpost'); // name là tên module
        parent::__construct();
    }
}
