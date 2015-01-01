<?php
interface Convenient_Data_Collection_Renderer_OrderRendererInterface
{
    /**
     * @param array $collection
     * @param array $orders
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function render(array $collection, array $orders);
}
