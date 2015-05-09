<?php
 
class Qchat_Chat_Model_Chat extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('chat/chat');
    }
}