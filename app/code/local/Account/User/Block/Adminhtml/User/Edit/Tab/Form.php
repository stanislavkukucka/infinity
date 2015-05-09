<?php
 
class Account_User_Block_Adminhtml_User_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('user_form', array('legend'=>Mage::helper('user')->__('User information')));
       
        $fieldset->addField('name', 'text', array(
            'label'     => Mage::helper('user')->__('Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'name',
        ));
		
		$fieldset->addField('email', 'text', array(
            'label'     => Mage::helper('user')->__('Email'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'email',
        ));
		
		$fieldset->addField('accout_type', 'text', array(
            'label'     => Mage::helper('user')->__('Account Type'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'accout_type',
        ));
		
		$fieldset->addField('user_image', 'text', array(
            'label'     => Mage::helper('user')->__('Image'),
            'name'      => 'user_image',
        ));
 
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('user')->__('Status'),
            'name'      => 'status',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('user')->__('Active'),
                ),
 
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('user')->__('Inactive'),
                ),
            ),
        ));
       
      
        if ( Mage::getSingleton('adminhtml/session')->getUserData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getUserData());
            Mage::getSingleton('adminhtml/session')->setUserData();
        } elseif ( Mage::registry('user_data') ) {
            $form->setValues(Mage::registry('user_data')->getData());
        }
        return parent::_prepareForm();
    }
}