<?php
class Convenient_Data_Collection_NoDb_OrdererTest extends PHPUnit_Framework_TestCase
{
    /** @var  Convenient_Data_Collection_NoDb_Orderer $orderer */
    protected $orderer;

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function setUp()
    {
        $this->orderer = new Convenient_Data_Collection_NoDb_Orderer;
    }

    /**
     * @param $collection
     * @param $orders
     * @param $expected
     *
     * @test
     * @dataProvider orderDateProvider
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderDate($collection, $orders, $expected)
    {
        $this->assertEquals($expected, $this->orderer->order($collection, $orders));
    }

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderDateProvider()
    {
        $rowA = new Varien_Object(
            array(
                'date' => '2015-04-01',
            )
        );

        $rowB = new Varien_Object(
            array(
                'date' => '2012-01-01',
            )
        );

        $rowC = new Varien_Object(
            array(
                'date' => '2015-02-01',
            )
        );

        return array(
            array(array($rowA, $rowB, $rowC), array('date' => 'ASC'), array($rowB, $rowC, $rowA)),
            array(array($rowA, $rowB, $rowC), array('date' => 'DESC'), array($rowA, $rowC, $rowB)),
        );
    }

    /**
     * @param $collection
     * @param $orders
     * @param $expected
     *
     * @test
     * @dataProvider orderDateTimeProvider
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderDateTime($collection, $orders, $expected)
    {
        $this->assertEquals($expected, $this->orderer->order($collection, $orders));
    }

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderDateTimeProvider()
    {
        $rowA = new Varien_Object(
            array(
                'date' => '2015-04-01 14:00:15',
            )
        );

        $rowB = new Varien_Object(
            array(
                'date' => '2015-04-01 10:00:10',
            )
        );

        $rowC = new Varien_Object(
            array(
                'date' => '2015-04-02 14:00:14',
            )
        );

        return array(
            array(array($rowA, $rowB, $rowC), array('date' => 'ASC'), array($rowB, $rowA, $rowC)),
            array(array($rowA, $rowB, $rowC), array('date' => 'DESC'), array($rowC, $rowA, $rowB)),
        );
    }

    /**
     * @param $collection
     * @param $orders
     * @param $expected
     *
     * @dataProvider orderNumericProvider
     * @test
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderNumeric($collection, $orders, $expected)
    {
        $this->assertEquals($expected, $this->orderer->order($collection, $orders));
    }

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderNumericProvider()
    {
        $rowA = new Varien_Object(
            array(
                'id' => '10',
            )
        );

        $rowB = new Varien_Object(
            array(
                'id' => '20',
            )
        );

        $rowC = new Varien_Object(
            array(
                'id' => '30',
            )
        );

        $rowD = new Varien_Object(
            array(
                'id' => '2',
            )
        );

        return array(
            array(array($rowA, $rowB, $rowC, $rowD), array('id' => 'DESC'), array($rowC, $rowB, $rowA, $rowD)),
            array(array($rowA, $rowB, $rowC, $rowD), array('id' => 'ASC'), array($rowD, $rowA, $rowB, $rowC)),
        );
    }

    /**
     * @param $collection
     * @param $orders
     * @param $expected
     *
     * @dataProvider orderTextProvider
     * @test
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderText($collection, $orders, $expected)
    {
        $this->assertEquals($expected, $this->orderer->order($collection, $orders));
    }

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function orderTextProvider()
    {
        $rowA = new Varien_Object(
            array(
                'code' => 'z',
            )
        );

        $rowB = new Varien_Object(
            array(
                'code' => 'a',
            )
        );

        $rowC = new Varien_Object(
            array(
                'code' => 'b',
            )
        );

        $row1 = new Varien_Object(
            array(
                'code' => 'a'
            )
        );

        $row2 = new Varien_Object(
            array(
                'code' => 'G',
            )
        );

        $row3 = new Varien_Object(
            array(
                'code' => 'g',
            )
        );

        $row4 = new Varien_Object(
            array(
                'code' => 'z'
            )
        );

        return array(
            array(array($rowA, $rowB, $rowC), array('code' => 'DESC'), array($rowA, $rowC, $rowB)),
            array(array($rowA, $rowB, $rowC), array('code' => 'ASC'), array($rowB, $rowC, $rowA)),
            array(array($row1, $row2, $row3, $row4), array('code' => 'ASC'), array($row1, $row3, $row2, $row4)),
            array(array($row1, $row2, $row3, $row4), array('code' => 'DESC'), array($row4, $row3, $row2, $row1)),
        );
    }
}

