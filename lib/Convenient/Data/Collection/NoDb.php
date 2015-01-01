<?php
class Convenient_Data_Collection_NoDb extends Varien_Data_Collection
{
    protected $orderRenderer = null;

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
     * @param array $collection
     * @return mixed
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function renderOrders($collection)
    {
        return $this->getOrderRenderer()->render($collection, $this->_orders);
    }
}
