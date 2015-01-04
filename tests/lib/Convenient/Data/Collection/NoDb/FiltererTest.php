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
     * @dataProvider dateProvider
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function date($collection, $filters, $expected)
    {
        $this->assertEquals($expected, $this->filterer->filter($collection, $filters));
    }

    /**
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function dateProvider()
    {
        $rowA = new Varien_Object(
            array(
                'field' => '2015-01-06'
            )
        );

        $rowB = new Varien_Object(
            array(
                'field' => '2015-01-08'
            )
        );

        $rowC = new Varien_Object(
            array(
                'field' => '2015-01-10'
            )
        );

        $rowD = new Varien_Object();

        $timestamp1 = new Zend_Date();
        $timestamp1->setTimestamp(strtotime('2015-01-07'));

        $timestamp2 = new Zend_Date();
        $timestamp2->setTimestamp(strtotime('2015-01-09'));

        return array(
            array(
                array($rowA, $rowB, $rowC, $rowD),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'date' => true,
                                    'from' => $timestamp1,
                                    'to' => $timestamp2
                                )
                            )
                        )
                    )
                ),
                array($rowB)
            ),
        );
    }

    /**
     * @param $collection
     * @param $filters
     * @param $expected
     *
     * @test
     * @dataProvider fromToProvider
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function fromTo($collection, $filters, $expected)
    {
        $this->assertEquals($expected, $this->filterer->filter($collection, $filters));
    }

    /**
     * @return array
     *
     * @author Luke Rodgers <lukerodgers90@gmail.com>
     */
    public function fromToProvider()
    {
        $rowA = new Varien_Object(
            array(
                'field' => 3
            )
        );

        $rowB = new Varien_Object(
            array(
                'field' => 6
            )
        );

        $rowC = new Varien_Object(
            array(
                'field' => 9
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
                                    'from' => 6
                                )
                            )
                        )
                    )
                ),
                array($rowB, $rowC)
            ),
            array(
                array($rowA, $rowB, $rowC),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'from' => 7
                                )
                            )
                        )
                    )
                ),
                array($rowC)
            ),
            array(
                array($rowA, $rowB, $rowC),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'to' => 7
                                )
                            )
                        )
                    )
                ),
                array($rowA, $rowB)
            ),
            array(
                array($rowA, $rowB, $rowC),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'to' => 6
                                )
                            )
                        )
                    )
                ),
                array($rowA, $rowB)
            ),
            array(
                array($rowA, $rowB, $rowC),
                array(
                    'field' => array(
                        new Varien_Object(
                            array(
                                'value' => array(
                                    'from' => 6,
                                    'to' => 9
                                )
                            )
                        )
                    )
                ),
                array($rowB, $rowC)
            ),
        );
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
