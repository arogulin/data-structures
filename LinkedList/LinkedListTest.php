<?php
require_once 'LinkedList.php';

class LinkedListTest extends PHPUnit_Framework_TestCase
{

    public function testCreateListFromArray()
    {
        $values = [3, 4, 5];
        $list = new LinkedList($values);
        $this->assertEquals($values, $list->toArray());
    }

    public function testInsertInBeginning()
    {
        $values = [3, 2, 1];
        $expectedValues = array_reverse($values);

        $list = new LinkedList();
        foreach ($values as $value) {
            $list->insert($value, 0);
        }

        $this->assertEquals($expectedValues, $list->toArray());
    }

    public function testInsertInEnd()
    {
        $values = [1, 2, 3];

        $list = new LinkedList();
        foreach ($values as $value) {
            $list->insert($value, 100);
        }

        $this->assertEquals($values, $list->toArray());
    }

    public function testInsertInRandomOrder()
    {
        // value => order
        $values = [
            1 => 0,
            2 => 1,
            3 => 1,
            4 => 0,
            5 => 2,
        ];
        $expectedValues = [4, 1, 5, 3, 2];

        $list = new LinkedList();
        foreach ($values as $value => $position) {
            $list->insert($value, $position);
        }

        $this->assertEquals($expectedValues, $list->toArray());
    }

    public function testDeleteFromBeginning()
    {
        $values = [1, 2, 3];

        $list = new LinkedList($values);
        $this->assertEquals($values, $list->toArray());

        for ($i = 0, $count = count($values); $i < $count; $i++) {
            array_shift($values);
            $list->delete(0);
            $this->assertEquals($values, $list->toArray());
        }
        $this->assertEmpty($list->toArray());
    }

    public function testDeleteFromEnd()
    {
        $values = [1, 2, 3];

        $list = new LinkedList($values);
        $this->assertEquals($values, $list->toArray());

        for ($i = count($values) - 1; $i >= 0; $i--) {
            array_pop($values);
            $list->delete($i);
            $this->assertEquals($values, $list->toArray());
        }
        $this->assertEmpty($list->toArray());
    }

    public function testDeleteInRandomOrder()
    {
        $order = [3, 2, 0, 1, 0];
        $values = [4, 1, 5, 3, 2];

        $list = new LinkedList($values);

        foreach ($order as $position) {
            $list->delete($position);
            unset($values[$position]);
            // Rebuild keys
            $values = array_values($values);
            $this->assertEquals($values, $list->toArray());
        }

        $this->assertEmpty($list->toArray());
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessageRegExp #Can't delete#
     */
    public function testErrorDeletePositionNotExists()
    {
        $list = new LinkedList([1, 2, 3]);
        $list->delete(100);
    }

    /**
     * @dataProvider providerReverse
     * @param array $originalValues
     * @param array $expectedValues
     */
    public function testReverseIterative(array $originalValues, array $expectedValues)
    {
        $list = new LinkedList($originalValues);
        $this->assertEquals($originalValues, $list->toArray());

        $list->reverseIterative();
        
        $this->assertEquals($expectedValues, $list->toArray());
    }

    /**
     * @dataProvider providerReverse
     * @param array $originalValues
     * @param array $expectedValues
     */
    public function testReverseRecursive(array $originalValues, array $expectedValues)
    {
        $list = new LinkedList($originalValues);
        $this->assertEquals($originalValues, $list->toArray());

        $list->reverseRecursive();

        $this->assertEquals($expectedValues, $list->toArray());
    }

    public function providerReverse()
    {
        return [
            [
                'original_values' => [1, 2, 3, 4, 5],
                'expected_values' => [5, 4, 3, 2, 1],
            ],
            [
                'original_values' => [1],
                'expected_values' => [1],
            ],
            [
                'original_values' => [],
                'expected_values' => [],
            ],
        ];
    }
}