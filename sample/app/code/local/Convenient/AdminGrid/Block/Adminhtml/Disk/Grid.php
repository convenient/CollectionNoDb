<?php
class Convenient_AdminGrid_Block_Adminhtml_Disk_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function _construct()
    {
        parent::_construct();
        $this->setId('convenient_grid_disk');
        $this->setDefaultSort('id');
        $this->setDefaultDir(Varien_Data_Collection::SORT_ORDER_ASC);
        $this->setUseAjax(true);
        $this->setDefaultLimit(30);
    }

    /**
     * @return string
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * @return null|string
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getRowUrl()
    {
        return null;
    }

    /**
     * @return $this|void
     * @throws Exception
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            array(
                'header' => $this->__('Id'),
                'type' => 'number',
                'index' => 'id',
            )
        );

        $this->addColumn(
            'code',
            array(
                'header' => $this->__('Code'),
                'type' => 'text',
                'index' => 'code',
            )
        );

        $this->addColumn(
            'number',
            array(
                'header' => $this->__('Number'),
                'type' => 'number',
                'index' => 'number',
            )
        );

        $this->addColumn(
            'what',
            array(
                'header' => $this->__('Text'),
                'type' => 'text',
                'index' => 'text'
            )
        );

        $this->addColumn(
            'datelol',
            array(
                'header' => $this->__('Date'),
                'type' => 'date',
                'index' => 'date'
            )
        );

        $this->addColumn(
            'datetimelol',
            array(
                'header' => $this->__('Date Time'),
                'type' => 'datetime',
                'index' => 'datetime',
                'filter_time' => true,
            )
        );

        /**
         * Populate the select dropdown
         */
        $selectOptions = array();
        foreach ($this->getCollection() as $item) {
            $selectOptions[$item->getData('select')] = $item->getData('select');
        }
        asort($selectOptions);
        $this->getCollection()->clear();

        $this->addColumn(
            'select',
            array(
                'header' => $this->__('Select'),
                'type' => 'options',
                'index' => 'select',
                'options' => $selectOptions
            )
        );
    }

    /**
     * @return Convenient_AdminGrid_Model_Resource_Collection_Disk|Varien_Data_Collection
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getCollection()
    {
        if (is_null($this->_collection)) {
            $this->_collection = Mage::getResourceSingleton('convenient_admingrid/collection_disk');
        }
        return $this->_collection;
    }
}
