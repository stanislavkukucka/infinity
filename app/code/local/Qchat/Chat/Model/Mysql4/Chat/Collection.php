<?php
 
class Qchat_Chat_Model_Mysql4_Chat_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('chat/chat');
    }
}