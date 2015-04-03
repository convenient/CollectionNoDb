<?php

class Convenient_AdminGrid_AdminGridDiskController extends Mage_Adminhtml_Controller_Action
{
    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function indexAction()
    {
        $this->_title($this->__('Convenient'))->_title($this->__('AdminGrid'));

        $this->loadLayout();
        $this->_setActiveMenu('convenient/grid');
        $this->_addContent($this->getLayout()->createBlock('convenient_admingrid_adminhtml/disk'));
        $this->renderLayout();
    }

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('convenient_admingrid_adminhtml/disk_grid')->toHtml()
        );
    }
}
