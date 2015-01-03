<?php
class Convenient_Data_Collection_NoDb_FiltererTest extends PHPUnit_Framework_TestCase
{
    /** @var  $filterer Convenient_Data_Collection_NoDb_Filterer*/
    protected $filterer;

    /**
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function setUp()
    {
        $this->filterer = new Convenient_Data_Collection_NoDb_Filterer;
    }

    /**
     * @param $collection
     * @param $filters
     * @param $expected
     *
     * @test
     * @dataProvider likeProvider
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function like($collection, $filters, $expected)
    {
        $this->assertEquals($expected, $this->filterer->filter($collection, $filters));
    }

    /**
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function likeProvider()
    {
        $rowA = new Varien_Object(
            array(
                'field' => 'muffin'
            )
        );

        $rowB = new Varien_Object(
            array(
                'field' => 'puffin'
            )
        );

        $rowC = new Varien_Object(
            array(
                'field' => 'whale'
            )
        );

        return array(
            array(
                array($rowA, $rowB, $rowC),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'like' => "'%uffin%'"
                                )
                            )
                        )
                    )
                ),
                array($rowA, $rowB)
            ),
        );
    }

    /**
     * @param $collection
     * @param $filters
     * @param $expected
     *
     * @test
     * @dataProvider equalsProvider
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function equals($collection, $filters, $expected)
    {
        $this->assertEquals($expected, $this->filterer->filter($collection, $filters));
    }

    /**
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function equalsProvider()
    {
        $rowA = new Varien_Object(
            array(
                'field' => 'foo'
            )
        );

        $rowB = new Varien_Object(
            array(
                'field' => 'bar'
            )
        );

        $rowC = new Varien_Object(
            array(
                'field' => 'foo'
            )
        );

        return array(
            array(
                array($rowA, $rowB, $rowC),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'eq' => 'foo'
                                )
                            )
                        )
                    )
                ),
                array($rowA, $rowC)
            ),
            array(
                array($rowA, $rowB, $rowC),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'eq' => 'bar'
                                )
                            )
                        )
                    )
                ),
                array($rowB)
            ),
        );
    }
}
