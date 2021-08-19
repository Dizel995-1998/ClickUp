<?php

namespace Service\ClickUp\Entity;

class Teams extends BaseEntity implements \Iterator
{
    /**
     * @var Team[]
     * @openToSerialize
     */
    protected array $teams;

    public function __construct(array $arData)
    {
        // TODO добавить валидацию
        foreach ($arData as $team) {
            $this->teams[] = new Team($team);
        }
    }

    public function current()
    {
        return current($this->teams);
    }

    public function next()
    {
        return next($this->teams);
    }

    public function key()
    {
        return key($this->teams);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->teams);
    }
}