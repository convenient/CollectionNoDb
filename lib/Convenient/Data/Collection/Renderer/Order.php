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
                    $val1 = $data1->getData($sortField);
                    $val2 = $data2->getData($sortField);

                    if (is_numeric($val1) && is_numeric($val2)) {
                        return ($directionMultiplier * ($val1 - $val2));
                    } elseif (strtotime($val1) || strtotime($val2)) {
                        return ($directionMultiplier * (strtotime($val1) - strtotime($val2)));
                    }

                    return ($directionMultiplier * strcasecmp($val1, $val2));
                }
            );
        }

        return $collection;
    }
}
