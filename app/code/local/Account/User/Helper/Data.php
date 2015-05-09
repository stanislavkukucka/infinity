<?php
 
class Account_User_Helper_Data extends Mage_Core_Helper_Abstract
{
  
    public function getLogoutUrl()
    {
        return $this->_getUrl('user/index/logout');
    }
	public function getProfileUrl()
    {
        return $this->_getUrl('user/index/profile');
    }
}