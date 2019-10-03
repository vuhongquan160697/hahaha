<?php
class Dtn_Weblog_Adminhtml_BlogpostController extends Mage_Adminhtml_Controller_Action{
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function newAction(){
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('weblog/adminhtml_form_edit'))
            ->_addLeft($this->getLayout()->createBlock('weblog/adminhtml_form_edit_tabs'));
        $this->renderLayout();
    }
    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
        }
    }
//    public function deleteAction() {
//        $id = $this->getRequest()->getParams('id');
//        $blogpost = Mage::getModel('weblog/blogpost');
//        $blogpost->load($id);
//        $blogpost->delete();
//        $blogpost->save();
//        $this->_redirect('*/*/');
//    }
//    public function massDeleteAction()
//    {
//        $blogpostIds = $this->getRequest()->getParam('id');
//        if (!is_array($blogpostIds)) {
//            $this->_getSession()->addError($this->__('Please select blogpost(s).'));
//        } else {
//            if (!empty($blogpostIds)) {
//                try {
//                    foreach ($blogpostIds as $blogpostId) {
//                        $blogpost = Mage::getSingleton('weblog/blogpost')->load($blogpostIds);
//                        Mage::dispatchEvent('catalog_controller_product_delete', array('blogpost' => $blogpost));
//                        $blogpost->delete();
//                    }
//                    $this->_getSession()->addSuccess(
//                        $this->__('Total of %d record(s) have been deleted.', count($blogpostIds))
//                    );
//                } catch (Exception $e) {
//                    $this->_getSession()->addError($e->getMessage());
//                }
//            }
//        }
//        $this->_redirect('*/*/index');
//    }
    /**
     * export grid sang CSV
     */
    public function exportCsvAction()
    {
        $fileName   = 'blogpost.csv';
        $content    = $this->getLayout()->createBlock('weblog/adminhtml_blogpost_grid');
        $this->_prepareDownloadResponse($fileName, $content->getCsvFile());

    }

    /**
     * export grid sang XML
     * nut export ben grid
     */
    public function exportXmlAction()
    {
        $fileName   = 'blogpost.xml';
        $content    = $this->getLayout()->createBlock('weblog/adminhtml_blogpost_grid');
        $this->_prepareDownloadResponse($fileName, $content->getExcelFile());
    }
}
