<?php
class Convenient_Data_Collection_NoDb extends Varien_Data_Collection
{
    /**
     * @param array $collection
     * @return mixed
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function renderOrders($collection)
    {
        $sortOrderDesc = self::SORT_ORDER_DESC;

        foreach (array_reverse($this->_orders, true) as $sortField => $direction) {
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
