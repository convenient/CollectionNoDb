<?php
class Convenient_Data_Collection_NoDb extends Varien_Data_Collection
{
    protected $orderRenderer = null;
    protected $data = array();
    protected $isLimitRendered = false;

    /**
     * @param Convenient_Data_Collection_Renderer_OrderRendererInterface $orderRenderer
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function setOrderRenderer(Convenient_Data_Collection_Renderer_OrderRendererInterface $orderRenderer)
    {
        $this->orderRenderer = $orderRenderer;
    }

    /**
     * @return Convenient_Data_Collection_Renderer_Order|Convenient_Data_Collection_Renderer_OrderRendererInterface
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function getOrderRenderer()
    {
        if (is_null($this->orderRenderer)) {
            $this->orderRenderer = new Convenient_Data_Collection_Renderer_Order;
        }
        return $this->orderRenderer;
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

    protected function _renderFilters()
    {
        if (!$this->_isFiltersRendered) {
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
     * @return $this|Varien_Data_Collection
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _renderOrders()
    {
        $this->data = $this->getOrderRenderer()->render($this->data, $this->_orders);
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
