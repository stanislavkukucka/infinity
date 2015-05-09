<?php
$installer = $this;
 
$installer->startSetup();
 
$installer->run("
ALTER TABLE {$this->getTable('user')} ADD COLUMN `last_login` datetime NULL;
");
$installer->endSetup();