<?php

namespace Service\ClickUp\Entity;

class IntervalCollection extends BaseEntity implements \Iterator
{
    /**
     * @openToSerialize
     * @var Interval[]
     */
    protected array $intervals = [];

    public function __construct(array $arData)
    {
        foreach ($arData as $interval) {
            $this->intervals[] = new Interval($interval);
        }
    }

    public function current()
    {
        return current($this->intervals);
    }

    public function next()
    {
        return next($this->intervals);
    }

    public function key()
    {
        return key($this->intervals);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->intervals);
    }
}