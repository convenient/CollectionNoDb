<?php
class Convenient_Data_Collection_Renderer_OrderTest extends PHPUnit_Framework_TestCase
{
    /** @var  Convenient_Data_Collection_Renderer_Order $orderer */
    protected $orderer;

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function setUp()
    {
        $this->orderer = new Convenient_Data_Collection_Renderer_Order;
    }

    /**
     * @param $collection
     * @param $orders
     * @param $expected
     *
     * @dataProvider dataTypeProvider
     * @test
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function sortByDataType($collection, $orders, $expected)
    {
        $this->assertEquals($expected, $this->orderer->render($collection, $orders));
    }

    /**
     * @param $collection
     * @param $orders
     * @param $expected
     *
     * @dataProvider stableSortProvider
     * @test
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function stableSort($collection, $orders, $expected)
    {
        $this->assertEquals($expected, $this->orderer->render($collection, $orders));
    }

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function stableSortProvider()
    {
        $rowA = new Varien_Object(
            array(
                'a' => 1,
                'b' => 7
            )
        );

        $rowB = new Varien_Object(
            array(
                'a' => 2,
                'b' => 7
            )
        );

        $rowC = new Varien_Object(
            array(
                'a' => 1,
                'b' => 8
            )
        );


        $rows = array(
            $rowA,
            $rowB,
            $rowC
        );

        return array(
            array($rows, array('a' => 'ASC', 'b' => 'DESC'), array($rowC, $rowA, $rowB)),
            array($rows, array('a' => 'DESC', 'b' => 'ASC'), array($rowB, $rowC, $rowA)),
        );
    }

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function dataTypeProvider()
    {
        $rowA = new Varien_Object(
            array(
                'id' => '10',
                'code' => 'dummy_code_z',
                'created_at' => '2015-04-01 10:00:00',
            )
        );

        $rowB = new Varien_Object(
            array(
                'id' => '20',
                'code' => 'dummy_code_a',
                'created_at' => '2015-01-01 10:30:00',
            )
        );

        $rowC = new Varien_Object(
            array(
                'id' => '30',
                'code' => 'dummy_code_y',
                'created_at' => '2015-02-01 10:30:01',
            )
        );

        $rows = array(
            $rowA,
            $rowB,
            $rowC
        );

        return array(
            //text
            array($rows, array('code' => 'DESC'), array($rowA, $rowC, $rowB)),
            array($rows, array('code' => 'ASC'), array($rowB, $rowC, $rowA)),
            //numeric
            array($rows, array('id' => 'DESC'), array($rowC, $rowB, $rowA)),
            array($rows, array('id' => 'ASC'), array($rowA, $rowB, $rowC)),
            //date
            array($rows, array('created_at' => 'DESC'), array($rowA, $rowC, $rowB)),
            array($rows, array('created_at' => 'ASC'), array($rowB, $rowC, $rowA)),
        );
    }
}
