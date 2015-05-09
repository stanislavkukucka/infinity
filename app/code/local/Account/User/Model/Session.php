<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Customer
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Customer session model
 *
 * @category   Mage
 * @package    Mage_Customer
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Account_User_Model_Session extends Mage_Core_Model_Session
{
  
    public function _construct()
    {
       
        $this->_init('user/session');
		
    }
     protected function _getSessionId()
    {
        return Mage::getSingleton('core/session')->getSessionHost();
    }
   /* public function getUserId()
    {
        $getuserid = Mage::getModel('user/user')->getCollection();
				foreach ($getuserid as $userid) {
					$i = 0;
				$userid->getUserId($i);
				$IdUser = $userid->getUserId($i);				
				}
				return  md5($IdUser);
       
    }*/

     public function isLoggedIn()
    {   
		 $getuserid = Mage::getModel('user/user')->getCollection();
				foreach ($getuserid as $userid) {
					$i = 0;
				$userid->getUserId($i);				
				
	     if(md5($userid->getUserId($i)) == $this->_getSessionId()){
		return true;
		break;
		 }
		
		} 
        
    }
	
	protected function _setAuthUrl($key, $url)
    {
        $url = Mage::helper('core/url')
            ->removeRequestParam($url, Mage::getSingleton('core/session')->getSessionIdQueryParam());
        $url = Mage::getModel('core/url')->getRebuiltUrl($url);
        return $this->setData($key, $url);
    }
	
	public function setBeforeAuthUrl($url)
    {
        return $this->_setAuthUrl('before_auth_url', $url);
    }
	
	public function getLoggedUser()
    {   
		 $getloggeduser = Mage::getModel('user/user')->getCollection();
				foreach ($getloggeduser as $userlogged) {
					$i = 0;
				$userlogged->getUserId($i);
				$LoggedUser = $userlogged->getUserId($i);				
				
			
	     if(md5($LoggedUser) == $this->_getSessionId()){
        return $LoggedUser;
		break;
		}
		}
    }
   
    
    public function renewSession()
    {
        parent::renewSession();
        Mage::getSingleton('core/session')->unsSessionHost();

        return $this;
    }
}
