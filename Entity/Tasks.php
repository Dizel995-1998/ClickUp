<?php

namespace Service\ClickUp\Entity;

class Tasks extends BaseEntity implements \Iterator
{
    /**
     * @var Task[] @openToSerialize
     */
    protected array $tasks = [];

    public function __construct(array $arData)
    {
        foreach ($arData as $data) {
            $this->tasks[] = new Task($data);
        }
    }

    public function current()
    {
        return current($this->tasks);
    }

    public function next()
    {
        return next($this->tasks);
    }

    public function key()
    {
        return key($this->tasks);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->tasks);
    }
}