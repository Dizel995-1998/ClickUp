<?php

namespace Service\ClickUp\Entity;

class Spaces extends BaseEntity implements \Iterator
{
    /**
     * @var Space[] @openToSerialize
     */
    protected array $spaces = [];

    public function __construct(array $arData)
    {
        foreach ($arData as $space) {
            $this->spaces[] = new Space($space);
        }
    }

    public function current()
    {
        return current($this->spaces);
    }

    public function next()
    {
        return next($this->spaces);
    }

    public function key()
    {
        return key($this->spaces);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->spaces);
    }
}