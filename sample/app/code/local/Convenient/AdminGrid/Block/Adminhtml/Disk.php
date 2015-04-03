<?php
class Convenient_AdminGrid_Block_Adminhtml_Disk extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function __construct()
    {
        $this->_controller = 'disk';
        $this->_blockGroup = 'convenient_admingrid_adminhtml';
        $this->_headerText = Mage::helper('convenient_admingrid')->__('Disk Accessed Data');

        parent::__construct();
        $this->_removeButton('add');
    }
}
