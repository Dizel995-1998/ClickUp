<?php

namespace Service\ClickUp\Entity;

class Folder extends BaseEntity
{
    /** @var string|mixed @openToSerialize */
    protected string $id;
    /** @var string|mixed @openToSerialize */
    protected string $name;
    protected int $orderIndex;
    protected bool $hidden;
    /** @var array|mixed @openToSerialize */
    protected array $statuses;
    protected string $taskCount;
    protected bool $archived;
    /** @var Space @openToSerialize */
    protected Space $space;

    public function __construct(array $arData)
    {
        $this->id = $arData['id'];
        $this->name = $arData['name'];
        $this->orderIndex = $arData['orderindex'];
        $this->hidden = $arData['hidden'];
        $this->statuses = $arData['statuses'];
        $this->taskCount = $arData['task_count'];
        $this->archived = $arData['archived'];
        $this->space = new Space($arData['space']);
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getOrderIndex() : int
    {
        return $this->orderIndex;
    }

    public function getStatuses() : array
    {
        return $this->statuses;
    }

    public function getHidden() : bool
    {
        return $this->hidden;
    }

    public function getArchivedStatus() : bool
    {
        return $this->archived;
    }

    public function getSpace() : Space
    {
        return $this->space;
    }

    public function getTaskCount() : string
    {
        return $this->taskCount;
    }
}