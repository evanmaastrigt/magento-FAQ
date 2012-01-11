<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$faqArticlesStoreTable = $installer->getTable('faq_articles_stores');

$installer->run("ALTER TABLE " . $faqArticlesStoreTable . " CHANGE COLUMN `content` `faq_content` TEXT  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");


$installer->endSetup();
