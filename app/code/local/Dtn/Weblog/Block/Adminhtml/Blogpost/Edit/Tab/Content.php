<?php
class Dtn_Weblog_Block_Adminhtml_Blogpost_Edit_Tab_Content
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setUseContainer(true);
        $this->setForm($form);
        if (Mage::getSingleton('adminhtml/session')->getFormData()){
            $data = Mage::getSingleton('adminhtml/session')->getFormData();
            Mage::getSingleton('adminhtml/session')->setFormData(null);
        }elseif(Mage::registry('blogpost_data'))
            $data = Mage::registry('blogpost_data')->getData();
        $fieldset = $form->addFieldset('blogpost_form', array('legend'=>Mage::helper('weblog')->__('Contenttttt')));
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('weblog')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'title',
        ));
        $fieldset->addField('post', 'text', array(
            'label'     => Mage::helper('weblog')->__('Post'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'post',
        ));
        $form->setValues($data);
        return parent::_prepareForm();
    }
    public function getTabLabel()
    {
        return Mage::helper('weblog')->__('Content');//Tên html bên tabs left
    }
    public function getTabTitle()
    {
        return Mage::helper('weblog')->__('Content');
    }
    public function canShowTab()
    {
        return true;
    }
    public function isHidden()
    {
        return false;
    }
}

