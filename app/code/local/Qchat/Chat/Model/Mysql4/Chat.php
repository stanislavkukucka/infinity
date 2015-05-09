<?php
 
class Qchat_Chat_Model_Mysql4_Chat extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('chat/chat', 'chat_id');
    }
}