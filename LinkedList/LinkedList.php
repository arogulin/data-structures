<?php
require_once 'LinkedListNode.php';

class LinkedList
{

    /** @var LinkedListNode|null */
    private $head;

    /** @var int Number of nodes in the list */
    private $count;

    /**
     * @param array $data
     */
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
        $newNode = new LinkedListNode($data);

        if ($position > $this->count) {
            // Always insert in the end of the list
            $position = $this->count;
        }

        if ($position === 0) {
            $this->insertFirstNode($newNode);
            return;
        }

        $currentNode = $this->head;
        for ($i = 0; $i < $position - 1; $i++) {
            $currentNode = $currentNode->getNext();
        }
        // Now $currentNode on $position - 1
        $newNode->setNext($currentNode->getNext());
        $currentNode->setNext($newNode);
        $this->count++;
    }

    /**
     * @param int $position
     * @throws Exception
     */
    public function delete($position)
    {
        if ($position > $this->count) {
            throw new \Exception('Can\'t delete position #' . $position . ' from list with ' . $this->count . ' nodes');
        }

        if ($position === 0) {
            $this->deleteFirstNode();
            return;
        }

        $currentNode = $this->head;
        for ($i = 0; $i < $position - 1; $i++) {
            $currentNode = $currentNode->getNext();
        }
        $deleteNode = $currentNode->getNext();
        $currentNode->setNext($deleteNode->getNext());
        $this->count--;
    }

    /**
     * Reverse the current list with memory efficient method.
     */
    public function reverseIterative()
    {
        $current = $this->head;
        $prev = null;
        while ($current instanceof LinkedListNode) {
            $next = $current->getNext();
            $current->setNext($prev);
            $prev = $current;
            $current = $next;
        }
        $this->head = $prev;
    }

    /**
     * Reverse the current list with memory inefficient method.
     */
    public function reverseRecursive()
    {
        if ($this->head === null) {
            // List is empty
            return;
        }
        $this->doReverseRecursive($this->head);
    }

    public function toArray()
    {
        $result = array();
        $temp = $this->head;
        while ($temp instanceof LinkedListNode) {
            $result[] = $temp->getData();
            $temp = $temp->getNext();
        }
        return $result;
    }

    /**
     * @param LinkedListNode $newNode
     */
    private function insertFirstNode(LinkedListNode $newNode)
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

    private function deleteFirstNode()
    {
        $this->count--;
        $this->head = $this->head->getNext();
    }

    /**
     * @param LinkedListNode $node
     */
    private function doReverseRecursive($node)
    {
        if ($node->getNext() === null) {
            // End of the list
            $this->head = $node;
            return;
        }
        $this->doReverseRecursive($node->getNext());
        $node->getNext()->setNext($node);
        $node->setNext(null);
    }
}