CollectionNoDb
==============

A collection for Magento 1.x admin panel that you can use without a database

```
<?php

class Namespace_Module_Model_Resource_Collection_DiskAccess extends Convenient_Data_Collection_NoDb
{
    /**
     * Create a filterable admin panel grid by reading in data.csv
     *
     * @return $this|array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    protected function fetchData()
    {
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

        return $data;
    }
}
```
