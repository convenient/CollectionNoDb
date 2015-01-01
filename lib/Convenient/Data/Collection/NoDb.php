<?php
class Convenient_Data_Collection_NoDb extends Varien_Data_Collection
{
    protected $orderRenderer = null;
    protected $dataNoDb = array();

    /**
     * @return Varien_Data_Collection|void
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function clear()
    {
        parent::clear();
        $this->dataNoDb = array();
    }

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
     * @return $this
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function loadNoDbData()
    {
        return $this;
    }

    protected function _renderFilters()
    {
        return $this;
    }

    protected function _renderLimit()
    {
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
        if ($this->isLoaded()) {
            return $this;
        }

        $this->loadNoDbData()
            ->_renderFilters()
            ->_renderOrders()
            ->_renderLimit();

        foreach ($this->dataNoDb as $d) {
            $this->addItem($d);
        }

        $this->_setIsLoaded(true);
        return $this;
    }

    /**
     * @return $this|Varien_Data_Collection
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function _renderOrders()
    {
        $this->dataNoDb = $this->getOrderRenderer()->render($this->dataNoDb, $this->_orders);
        return $this;
    }
}
