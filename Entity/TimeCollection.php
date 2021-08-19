<?php

namespace Service\ClickUp\Entity;

class TimeCollection extends BaseEntity implements \Iterator
{
    /**
     * @openToSerialize
     * @var TimeEntity[]
     */
    protected array $taskCollection = [];

    public function __construct(array $arData)
    {
        foreach ($arData as $timeTask) {
            $this->taskCollection[] = new TimeEntity($timeTask);
        }
    }

    public function getTaskIds() : ?array
    {
        $arIds = null;

        foreach ($this->taskCollection as $timeEntity) {
            $arIds[] = $timeEntity->getTask()->getId();
        }

        return $arIds;
    }

    public function current()
    {
        return current($this->taskCollection);
    }

    public function next()
    {
        return next($this->taskCollection);
    }

    public function key()
    {
        return key($this->taskCollection);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->taskCollection);
    }
}