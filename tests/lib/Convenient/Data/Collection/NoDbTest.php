<?php
class Convenient_Data_Collection_NoDbTest extends PHPUnit_Framework_TestCase
{
    protected $collection;

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function setUp()
    {
        $this->collection = $this->getMockBuilder('Convenient_Data_Collection_Db')
            ->setMethods(null)
            ->getMock();
    }

    public function testTest()
    {
        $this->assertEquals(1, 1);
    }
}
