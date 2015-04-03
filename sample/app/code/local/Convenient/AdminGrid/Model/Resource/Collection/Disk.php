<?php

class Convenient_AdminGrid_Model_Resource_Collection_Disk extends Convenient_Data_Collection_NoDb
{
    protected $objectCachedData = null;

    /**
     * Create a filterable admin panel grid by reading in data.csv
     *
     * @return $this|array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function fetchData()
    {
        if (is_null($this->objectCachedData)) {
            $data = array();

            $handle = fopen('data.csv', 'r');
            if (!$handle) {
                die("Failed to open file");
            }

            $headersData = fgetcsv($handle);
            if ($headersData == false) {
                die("Failed to load file headers");
            }

            while (($line = fgetcsv($handle)) !== false) {
                $temp = array_combine($headersData, $line);

                $item = $this->getNewEmptyItem();
                $item->addData($temp);
                $data[] = $item;
            }

            fclose($handle);

            $this->objectCachedData = $data;
        }
        return $this->objectCachedData;
    }
}
