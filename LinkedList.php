<?php

class Node {
    private $data;
    private $next;

    /**
     * @param mixed $data
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * @return self|null
     */
    public function getNext() {
        return $this->next;
    }

    /**
     * @param self|null $next
     */
    public function setNext($next) {
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }
}

class LinkedList {

    private $head;

    public function insert($data, $position) {
        $newNode = new Node($data);

        if ($position === 1) {
            if ($this->head === null) {
                $this->head = $newNode;
                return;
            }
            $newNode->setNext($this->head);
            $this->head = $newNode;
        }
    }

    public function __toString() {
        $string = 'List: ';
        $temp = $this->head;
        if ($temp === null) {
            return $string;
        }
        while ($temp->getNext() instanceof Node) {
            $temp = $temp->getNext();
            $string .= $temp->getData() . ' ';
        }
        return $string;
    }
}

$list = new LinkedList();
$list->insert(1, 1);
$list->insert(2, 1);
$list->insert(3, 1);
echo $list;
echo '<pre>';
var_dump($list);
echo '</pre>';
die();