<?php
 
class Account_User_Block_Adminhtml_User_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('userGrid');
        // This is the primary key of the database
        $this->setDefaultSort('user_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('user/user')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('user_id', array(
            'header'    => Mage::helper('user')->__('ID'),
            'align'     =>'right',
            'width'     => '30px',
            'index'     => 'user_id',
        ));
 
        $this->addColumn('name', array(
            'header'    => Mage::helper('user')->__('Name'),
            'align'     => 'left',
			'width'     => '80px',
            'index'     => 'name',
        ));
       
        $this->addColumn('email', array(
            'header'    => Mage::helper('user')->__('Email'),
			'align'     => 'left',
            'width'     => '130px',
            'index'     => 'email',
        ));
		
		$this->addColumn('accout_type', array(
            'header'    => Mage::helper('user')->__('Account Type'),
			'align'     => 'left',
            'width'     => '70px',
            'index'     => 'accout_type',
        ));
    
 
        $this->addColumn('created_time', array(
            'header'    => Mage::helper('user')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '70px',
            'index'     => 'created_time',
        ));
 
        $this->addColumn('update_time', array(
            'header'    => Mage::helper('user')->__('Update Time'),
            'align'     => 'left',
            'width'     => '70px',
            'index'     => 'update_time',
        ));   
 
 
        $this->addColumn('status', array(
 
            'header'    => Mage::helper('user')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
		
		$this->addColumn('password', array(
            'header'    => Mage::helper('user')->__('Password'),
			'align'     => 'left',
            'width'     => '50px',
            'index'     => 'password',
        ));
		
		$this->addColumn('last_login', array(
            'header'    => Mage::helper('user')->__('Last Login'),
			'align'     => 'left',
            'width'     => '100px',
            'index'     => 'last_login',
        ));
		
		$this->addColumn('user_image', array(
            'header'    => Mage::helper('user')->__('Image'),
            'align'     =>'left',
            'index'     => 'user_image',
        ));
 
        return parent::_prepareColumns();
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}