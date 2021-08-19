<?php

namespace Service\ClickUp\Entity;

class Statuses extends BaseEntity implements \Iterator
{
    /**
     * @var Status[]
     * @openToSerialize
     */
    protected array $statuses = [];

    public function __construct(?array $arData)
    {
        if ($arData) {
            foreach ($arData as $status) {
                $this->statuses[] = new Status($status);
            }
        }
    }


    public function current()
    {
        return current($this->statuses);
    }

    public function next()
    {
        return next($this->statuses);
    }

    public function key()
    {
        return key($this->statuses);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->statuses);
    }
}