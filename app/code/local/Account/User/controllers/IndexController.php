<?php
class Account_User_IndexController extends Mage_Core_Controller_Front_Action
{
  
	
    protected function _getSession()
    {
        return Mage::getSingleton('user/session');
    }
	
    public function indexAction()
    {
				
    
            $this->loadLayout();
            $this->renderLayout();
			
			
    }
	   
     public function profileAction()
    {
	 
    
            $this->loadLayout();
            $this->renderLayout();
			
			
    }
	public function loginAction()
    {        
			 $name = $_POST['namel'];
			  $password = $_POST['passwordl'];
			  $passwordh = md5($password);
		if(empty($name) || empty($password)){
		   echo "Login and password are required.";
			}else{	
			  $users = Mage::getModel('user/user')->getCollection();
				foreach ($users as $item) {
					$i = 0;
					$item->getName($i);
				$item->getPassword($i);
				$item->getEmail($i);
				$item->getLastLogin($i);
				$item->getUserId($i);
				$item->getStatus($i);


				if($item->getName($i) == $name && $item->getPassword($i) == $passwordh &&  $item->getEmail($i) == $item->getEmail($i)){
				 if ($item->getStatus($i) == 0) {
				 $varnot = true;
				 }else{
				$user_hash = $item->getUserId($i);
				Mage::getSingleton('core/session')->setSessionHost(md5($user_hash));
				
				date_default_timezone_set('Europe/Belgrade');
				$curdate = date("Y-m-d H:i:s");
		        $item->setLastLogin($curdate);
			    $item->save();	
				$var = true;
				}
				}
				}
				if($var == true){				
				echo "Login Successful.</br></br>";
				
				
				$url = "http://test.com/index.php";
				echo "<a href=".$url.">Click to continue</a>";
				
				 }else if ($varnot == true){
				  echo "Account isn't conformed!";
				 }else{
				echo "Login user or password is incorrect.";}
         }
    }
	public function registerAction()
    {		
		date_default_timezone_set('Europe/Belgrade');
      

		$curdate = date("Y-m-d H:i:s");
		 $name = $_POST['name'];
		  $email = $_POST['email'];
		  $password = $_POST['password'];
		  $passwordre = $_POST['passwordre'];
		  $usersinfo = Mage::getModel('user/user')->getCollection();
				foreach ($usersinfo as $valid) {
					$i = 0;
				$valid->getName($i);				
				$valid->getEmail($i);
				$valname = $valid->getName($i);	
				$valemail = $valid->getEmail($i);
				if ($valname == $name){
				$valn = true;
				}if ($valemail == $email){
				$vale = true;
				 }
				}
				
		  if(empty($name) || empty($password) || empty($passwordre) || empty($email)){
		   echo "Please fill the required fields.";
		   }else if ($valn == true){
		     echo "Username already exist!";
			} else if(strlen($name) > 25) {
			echo "Username is too long!";
			} else if(strlen($name) < 5) {
			echo "Username is too short!";
			}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  echo "Invalid email format";  
		   }else if ($vale == true){
		     echo "Email already exist!";			
			} else if(strlen($password) > 25) {
			echo "Password is too long!";			
			} else if(strlen($password) < 5) {
			echo "Password is too short!";
		   }else if ($password !== $passwordre){
		   echo "Password fields values aren't same."; 
			}else{	
		  $object = Mage::getModel('user/user');
		 $object
				->setName($name)
				->setEmail($email)
				->setPassword(md5($password))
				->setCreatedTime($curdate);
			
			$object->save();
			if ($object->save()){
			echo "Registration Successful.</br></br>";
		/*	$continue = true;
			
			if ($continue == true){
			include_once('./sendemail.php');
			}else {
			echo "wrong with form";
			}  */
			
			
			
			$url = "http://test.com/index.php/";
				echo "<a href=".$url.">Click to continue</a>";
			}else{
			echo "Registration failure.";
		}
    }
	}
	 public function logoutAction()
    {
        $this->_getSession()->renewSession();

        $this->_redirect('/*/*');
    }
}