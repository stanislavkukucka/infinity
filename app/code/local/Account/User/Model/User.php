<?php
 
class Account_User_Model_User extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
       
        $this->_init('user/user');
		
    }
}