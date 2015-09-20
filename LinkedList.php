<?php

class Node
{
    /** @var mixed */
    private $data;

    /** @var self|null */
    private $next;

    /**
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return self|null
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param self|null $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}

class LinkedList
{

    /** @var Node|null */
    private $head;

    /** @var int Number of nodes in the list */
    private $count;

    public function __construct(array $data = array())
    {
        $this->count = 0;
        $values = array_values($data);
        for ($i = 0; $i < count($values); $i++) {
            $this->insert($values[$i], $i);
        }
    }


    /**
     * @param mixed $data
     * @param int   $position
     * @throws \Exception
     */
    public function insert($data, $position)
    {
        $newNode = new Node($data);

        if ($position > $this->count) {
            // Always insert in the end of the list
            $position = $this->count;
        }

        if ($position === 0) {
            $this->insertFirstNode($newNode);
            return;
        }

        $temp = $this->head;
        for ($i = 0; $i < $position - 1; $i++) {
            $temp = $temp->getNext();
        }
        // Now temp is $position - 1
        $newNode->setNext($temp->getNext());
        $temp->setNext($newNode);
        $this->count++;
    }

    public function __toString()
    {
        $string = 'List: ';
        $temp = $this->head;
        if ($temp === null) {
            return $string;
        }
        while ($temp->getNext() instanceof Node) {
            $string .= $temp->getData() . ' ';
            $temp = $temp->getNext();
        }
        $string .= $temp->getData() . ' ';
        return $string;
    }

    public function toArray()
    {
        $result = array();
        $temp = $this->head;
        while ($temp instanceof Node) {
            $result[] = $temp->getData();
            $temp = $temp->getNext();
        }
        return $result;
    }

    private function insertFirstNode(Node $newNode)
    {
        $this->count++;

        // List is empty
        if ($this->head === null) {
            $this->head = $newNode;
            return;
        }
        $newNode->setNext($this->head);
        $this->head = $newNode;
        return;
    }
}