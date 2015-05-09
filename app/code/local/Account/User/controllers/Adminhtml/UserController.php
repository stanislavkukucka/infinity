<?php
 
class Account_User_Adminhtml_UserController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('user/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('User Manager'), Mage::helper('adminhtml')->__('User Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('user/adminhtml_user'));
        $this->renderLayout();
    }
 
    public function editAction()
    {
        $userId     = $this->getRequest()->getParam('id');
        $userModel  = Mage::getModel('user/user')->load($userId);
 
        if ($userModel->getId() || $userId == 0) {
 
            Mage::register('user_data', $userModel);
 
            $this->loadLayout();
            $this->_setActiveMenu('user/items');
           
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('User Manager'), Mage::helper('adminhtml')->__('User Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('User Info'), Mage::helper('adminhtml')->__('User Info'));
           
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
           
            $this->_addContent($this->getLayout()->createBlock('user/adminhtml_user_edit'))
                 ->_addLeft($this->getLayout()->createBlock('user/adminhtml_user_edit_tabs'));
               
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('user')->__('User does not exist'));
            $this->_redirect('*/*/');
        }
		$edit = true;
    }
   
    public function newAction()
    {
        $this->_forward('edit');
		
    }
   
    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $userModel = Mage::getModel('user/user');
               
                $userModel->setId($this->getRequest()->getParam('id'))
					->setName($postData['name'])
					->setEmail($postData['email'])
					->setAccoutType($postData['accout_type'])
					->setUserImage($postData['user_image'])
                    ->setStatus($postData['status']);
					$curdate = date("Y-m-d H:i:s");
					

					if ($edit !== true){
					 $userModel->setCreatedTime($curdate);		
					 $userModel->save();
					}else {
					$userModel->setUpdateTime($curdate);
                    $userModel->save();
                    }
					
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('User was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setUserData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setUserData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
   
    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $userModel = Mage::getModel('user/user');
               
                $userModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('User was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('user/adminhtml_user_grid')->toHtml()
        );
    }
}