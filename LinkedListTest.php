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

}