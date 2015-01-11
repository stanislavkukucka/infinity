 <?php
 require_once('./app/Mage.php');
Mage::app();
date_default_timezone_set('Europe/Belgrade');

$curdate = date("Y-m-d H:i:s");
 $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $object = Mage::getModel('user/user');
 $object
		->setName($name)
		->setEmail($email)
		->setPassword($password)
		->setCreatedTime($curdate);
    
    $object->save();
	if ($object->save())
	echo "super";
	else
	echo "nisuper";
	
  ?>