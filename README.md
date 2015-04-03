CollectionNoDb
==============

A collection for Magento 1.x admin panel that you can use without a database

## Example
You can turn this

![csv data](https://github.com/convenient/CollectionNoDb/raw/master/sample/csv.png "CSV Data")

Into this

![admin panel grid filtering the csv data](https://github.com/convenient/CollectionNoDb/raw/master/sample/csv-grid.png "Admin panel grid filtering the csv data")

## Configuration

The configuration of the grid is fairly typical, the only real condition is that there are only a few filter types supported

* Options (select dropdown)
* Date
* Datetime
* Text
* Number (From and To)

View the following file to see an example grid declaration

[Convenient_AdminGrid_Block_Adminhtml_Disk_Grid](https://github.com/convenient/CollectionNoDb/raw/master/sample/app/code/local/Convenient/AdminGrid/Block/Adminhtml/Disk/Grid.php)

### Defining the Data Source

In this example we're reading the data in from a csv, you could use anything you feel like. Just extend the library class and define the `fetchData` source. 

In the following example you can see that I've used object caching as well as the cache storage in order to ease the insanity of disk access.

[Convenient_AdminGrid_Model_Resource_Collection_Disk](https://github.com/convenient/CollectionNoDb/raw/master/sample/app/code/local/Convenient/AdminGrid/Model/Resource/Collection/Disk.php)
