<?php
 
class Account_User_Model_Mysql4_User extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('user/user', 'user_id');
    }
}