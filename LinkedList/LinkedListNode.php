<?php

class LinkedListNode
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
