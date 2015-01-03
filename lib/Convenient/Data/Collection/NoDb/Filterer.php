<?php
class Convenient_Data_Collection_NoDb_Filterer
{
    /**
     * @param array $collection
     * @param array $filters
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function filter(array $collection, array $filters)
    {
        return array_filter($collection, $this->filterCallback($filters));
    }

    /**
     * @param $filtersMap
     * @return callable
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function filterCallback($filtersMap)
    {
        return function ($row) use ($filtersMap) {

            $filterAbleFields = array_keys($filtersMap);

            /** @var Varien_Object $row */
            foreach ($filterAbleFields as $field) {

                $value = $row->getData($field);

                /** @var Varien_Object $filterContainer */
                foreach ($filtersMap[$field] as $filterContainer) {

                    $filter = $filterContainer->getData('value');

                    if (isset($filter['eq'])) {
                        if ($filter['eq'] != $value) {
                            return false;
                        }
                    } elseif (isset($filter['date'])) {

                        $rowDate = strtotime($value);
                        if (!$rowDate) {
                            return false;
                        }

                        if (isset($filter['from'])) {
                            /** @var Zend_Date $from */
                            $from = $filter['from'];

                            if ($rowDate < $from->getTimestamp()) {
                                return false;
                            }
                        }

                        if (isset($filter['to'])) {
                            /** @var Zend_Date $to */
                            $to = $filter['to'];

                            if ($rowDate > $to->getTimestamp()) {
                                return false;
                            }
                        }

                    } elseif (isset($filter['datetime'])) {
                        $rowDate = strtotime($value);
                        if (!$rowDate) {
                            return false;
                        }

                        if (isset($filter['from'])) {
                            $from = $filter['from'];

                            $dateTimestamp = date("Y-m-d", $from->getTimestamp());
                            $hoursTimeStamp = date("H:i:s", strtotime($filter['orig_from']));
                            $fullDateTime = strtotime($dateTimestamp . ' ' . $hoursTimeStamp);

                            if ($rowDate < $fullDateTime) {
                                return false;
                            }

                        }

                        if (isset($filter['to'])) {
                            $to = $filter['to'];

                            $dateTimestamp = date("Y-m-d", $to->getTimestamp());
                            $hoursTimeStamp = date("H:i:s", strtotime($filter['orig_to']));
                            $fullDateTime = strtotime($dateTimestamp . ' ' . $hoursTimeStamp);

                            if ($rowDate > $fullDateTime) {
                                return false;
                            }
                        }

                    } elseif (isset($filter['from']) || isset($filter['to'])) {

                        if (isset($filter['from'])) {
                            $from = $filter['from'];
                            if ($value < $from) {
                                return false;
                            }
                        }

                        if (isset($filter['to'])) {
                            $to = $filter['to'];
                            if ($value > $to) {
                                return false;
                            }
                        }

                    } elseif (isset($filter['like'])) {
                        if (stripos($value, substr($filter['like'], 2, -2)) === false) {
                            return false;
                        }
                    } else {
                        Mage::throwException("Unsupported filter used");
                    }
                }
            }

            return true;
        };
    }
}
