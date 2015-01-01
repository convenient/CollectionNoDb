<?php
//Mage bootstrap for autoloading etc
if (!class_exists('Mage', false)) {
    require_once(dirname(__FILE__) . '/../../app/Mage.php');
    Mage::app();
}
