<?php

namespace Service\ClickUp\Entity;

class Space extends BaseEntity
{
    /** @var string|mixed @openToSerialize */
    protected string $id;
    /** @var string|mixed @openToSerialize */
    protected string $name;
    /** @var Statuses @openToSerialize */
    protected Statuses $statutes;

    public function __construct(array $arData)
    {
        $this->id = $arData['id'];
        $this->name = $arData['name'];
        $this->statutes = new Statuses($arData['statuses']);
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getStatuses() : Statuses
    {
        return $this->statutes;
    }
}