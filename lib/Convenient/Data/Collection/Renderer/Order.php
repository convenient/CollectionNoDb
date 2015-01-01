<?php
class Convenient_Data_Collection_Renderer_Order implements Convenient_Data_Collection_Renderer_OrderRendererInterface
{
    /**
     * @param array $collection
     * @param array $orders
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function render(array $collection, array $orders)
    {
        $sortOrderDesc = Varien_Data_Collection::SORT_ORDER_DESC;

        foreach (array_reverse($orders, true) as $sortField => $direction) {
            usort(
                $collection,
                function (Varien_Object $data1, Varien_Object $data2) use ($sortField, $direction, $sortOrderDesc) {
                    $directionMultiplier = !strcasecmp($direction, $sortOrderDesc) ? -1 : 1;
                    return ($directionMultiplier * strcasecmp($data1[$sortField], $data2[$sortField]));
                }
            );
        }

        return $collection;
    }
}
