<?php

class Dtn_Weblog_Adminhtml_BlogpostController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
//        $this->loadLayout();
//        $this->_addContent($this->getLayout()->createBlock('weblog/adminhtml_form_edit'))
//            ->_addLeft($this->getLayout()->createBlock('weblog/adminhtml_form_edit_tabs'));
//        $this->renderLayout();
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $blogpost = Mage::getModel('weblog/blogpost');
        if ($id) {
            $blogpost->load((int)$id);
            if ($blogpost->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $blogpost->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('awesome')->__('The Gift Registry does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('blogpost_data', $blogpost);
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();


    }

    public function saveeeeeeAction()
    {

        $data = $this->getRequest()->getPost();
        if ($data)
        {
            $blogpost = Mage::getModel('weblog/blogpost');
            try {
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $blogpost->load($id);
                    $blogpost->setTitle($data['title']);
                    $blogpost->setPost($data['post']);
//                    $blogpost->setData($data);
                }
            } catch (Exception $e) {
                $this->_getSession()
                    ->addError(Mage::helper('weblog')->__('An error occurred while saving the registry data. Please review the log and try again.')
                );
                Mage::logException($e);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('blogpost_id')));
                return $this;
            }
            $blogpost->setTitle($data['title']);
            $blogpost->setPost($data['post']);
            $blogpost->save();
            $this->_getSession()->addSuccess($this->__('The blogpost has been saved.'));
            $this->_redirect('*/*/index', array('id' => $this->getRequest()->getParam('blogpost_id')));
        }
    }
    public function deleteAction()
    {
        $blogpostId = (int) $this->getRequest()->getParams('id');
        $blogpost = Mage::getModel('weblog/blogpost');
        if ($blogpostId){
            $blogpost->load($blogpostId);
        }
        Mage::register('current_blogpost',$blogpost);
        $blogpost = Mage::registry('current_blogpost');
        if ($blogpost->getId()) {
            try {
                $blogpost->load($blogpost->getId());
                $blogpost->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('The customer has been deleted.'));
            }
            catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
    /**
     * delete
     */
    public function massDeleteAction()
    {
        $blogpostIds = $this->getRequest()->getParam('blogpost');
        if (!is_array($blogpostIds)) {
            Mage::getSingleton('adminhtml/session')->
            addError(Mage::helper('weblog')->__('Please select one or more registries.'));
        } else {
            try {
                $blogpost = Mage::getModel('weblog/blogpost');
                foreach ($blogpostIds as $blogpostId) {
                    $blogpost->load($blogpostId)->delete();
                }
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($blogpostIds)));
            } catch (Exception $e) {
                Mage::getSingleton
                ('adminhtml/session')->
                addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export grid sang CSV
     */
    public function exportCsvAction()
    {
        $fileName = 'blogpost.csv';
        $content = $this->getLayout()->createBlock('weblog/adminhtml_blogpost_grid');
        $this->_prepareDownloadResponse($fileName, $content->getCsvFile());

    }

    /**
     * export grid sang XML
     * nut export ben grid
     */
    public function exportXmlAction()
    {
        $fileName = 'blogpost.xml';
        $content = $this->getLayout()->createBlock('weblog/adminhtml_blogpost_grid');
        $this->_prepareDownloadResponse($fileName, $content->getExcelFile());
    }
}
