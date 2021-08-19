<?php

namespace Service\ClickUp\Entity;

class Status extends BaseEntity
{
    /**
     * @var string|mixed
     * @openToSerialize
     */
    protected string $id;
    /**
     * @var string|mixed
     * @openToSerialize
     */
    protected string $name;
    /**
     * @var string|mixed
     * @openToSerialize
     */
    protected string $type;

    public function __construct(array $arData)
    {
        $this->id = $arData['id'] ?: '';
        $this->name = $arData['status'];
        $this->type = $arData['type'];
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getType() : string
    {
        return $this->type;
    }
}