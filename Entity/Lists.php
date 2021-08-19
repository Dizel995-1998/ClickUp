<?php

namespace Service\ClickUp\Entity;

class Lists extends BaseEntity implements \Iterator
{
    /**
     * @var ListEntity[] @openToSerialize
     */
    protected array $lists;

    public function __construct(array $arData)
    {
        foreach ($arData as $arList) {
            $this->lists[] = new ListEntity($arList);
        }
    }

    public function current()
    {
        return current($this->lists);
    }

    public function next()
    {
        return next($this->lists);
    }

    public function key()
    {
        return key($this->lists);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->lists);
    }
}