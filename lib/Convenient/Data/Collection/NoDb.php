<?php
class Convenient_Data_Collection_NoDb extends Varien_Data_Collection
{
    protected $orderer = null;
    protected $filterer = null;
    protected $data = array();
    protected $isLimitRendered = false;

    /**
     * @param $orderer
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function setOrderer($orderer)
    {
        $this->orderer = $orderer;
    }

    /**
     * @return Convenient_Data_Collection_NoDb_Orderer
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getOrderer()
    {
        if (is_null($this->orderer)) {
            $this->orderer = new Convenient_Data_Collection_NoDb_Orderer;
        }
        return $this->orderer;
    }

    /**
     * @param $filterer
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function setFilterer($filterer)
    {
        $this->filterer = $filterer;
    }

    /**
     * @return Convenient_Data_Collection_NoDb_Filterer
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getFilterer()
    {
        if (is_null($this->filterer)) {
            $this->filterer = new Convenient_Data_Collection_NoDb_Filterer;
        }
        return $this->filterer;
    }

    /**
     * @param $field
     * @param null $condition
     * @return $this
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function addFieldToFilter($field, $condition = null)
    {
        $this->addFilter($field, $condition);
        return $this;
    }

    /**
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function fetchData()
    {
        return array();
    }

    /**
     * @return $this|Varien_Data_Collection
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _renderOrders()
    {
        $this->data = $this->getOrderer()->order($this->data, $this->_orders);
        return $this;
    }

    /**
     * @return $this|Varien_Data_Collection
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _renderFilters()
    {
        if (!$this->_isFiltersRendered) {

            $filters = array();

            if (!empty($this->data)) {
                $firstItem = reset($this->data);
                if ($firstItem) {
                    foreach ($firstItem->getData() as $field => $value) {
                        $filter = $this->getFilter(array($field));
                        if (!empty($filter)) {
                            $filters[$field] = $filter;
                        }
                    }
                }
            }

            if (!empty($filters)) {
                $this->data = $this->getFilterer()->filter($this->data, $filters);
            }

            $this->_isFiltersRendered = true;
        }
        return $this;
    }

    /**
     * @return $this|Varien_Data_Collection
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _renderLimit()
    {
        if (!$this->isLimitRendered) {

            if (!$pageSize = $this->getPageSize()) {
                return $this;
            }

            $this->_totalRecords = count($this->data);
            $offset = $pageSize * ($this->getCurPage() - 1);
            $this->data = array_slice($this->data, $offset, $pageSize);

            $this->isLimitRendered = true;
        }
        return $this;
    }

    /**
     * @param bool $printQuery
     * @param bool $logQuery
     * @return $this|Varien_Data_Collection
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        return $this->load($printQuery, $logQuery);

    }

    /**
     * @return $this
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _beforeLoad()
    {
        return $this;
    }

    /**
     * @return $this
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _afterLoad()
    {
        return $this;
    }

    /**
     * @return $this
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _afterLoadData()
    {
        return $this;
    }

    /**
     * @return $this
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function resetData()
    {
        $this->data = array();
        return $this;
    }

    /**
     * @return mixed
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getData()
    {
        if ($this->data === array()) {

            $this->data = $this->fetchData();

            $this->_renderFilters()
                ->_renderOrders()
                ->_renderLimit();

            $this->_afterLoadData();
        }
        return $this->data;
    }

    /**
     * @return int
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getSize()
    {
        if (is_null($this->_totalRecords)) {
            $this->load();
            $this->_totalRecords = count($this->getItems());
        }
        return intval($this->_totalRecords);
    }

    /**
     * @param bool $printQuery
     * @param bool $logQuery
     * @return $this|Varien_Data_Collection
     * @throws Exception
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function load($printQuery = false, $logQuery = true)
    {
        if ($this->isLoaded()) {
            return $this;
        }

        $this->_beforeLoad();

        $data = $this->getData();
        $this->resetData();

        if (is_array($data)) {
            foreach ($data as $row) {
                $this->addItem($row);
            }
        }

        $this->_setIsLoaded();
        $this->_afterLoad();
        return $this;
    }
}
