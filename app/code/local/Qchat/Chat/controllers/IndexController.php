<?php
class Qchat_Chat_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
            $this->loadLayout();
            $this->renderLayout();
    }
	public function chatAction()
    {
            date_default_timezone_set('Europe/Belgrade');
			$curdate = date("Y-m-d H:i:s");
			$message = $_POST['message'];
			$userindex = Mage::getSingleton('user/session')->getLoggedUser(); 
			$chatobject = Mage::getModel('chat/chat');
			$chatobject
				->setUserChatid($userindex)
				->setContent($message)
				->setCreatedTime($curdate);
			
			$chatobject->save();
		if ($chatobject->save()){
			echo "Registration Successful.";		
			}else{
			echo "Registration failure.";
		}	
			
    }
	public function deleteAction()
    {
			$delmessage = $_POST['delmessage'];
			$chatmsg = Mage::getModel('chat/chat')->load($delmessage);
			$chatmsg->delete();
			if ($chatmsg->delete()){
			echo "Deleted.";		
			}else{
			echo "Not deleted.";
		}
	}
}