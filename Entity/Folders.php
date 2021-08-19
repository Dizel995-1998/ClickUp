<?php

namespace Service\ClickUp\Entity;

class Folders extends BaseEntity implements \Iterator
{
    /**
     * @var Folder[] @openToSerialize
     */
    protected array $folders = [];

    public function __construct(array $arData)
    {
        foreach ($arData as $arFolder) {
            $this->folders[] = new Folder($arFolder);
        }
    }

    public function current()
    {
        return current($this->folders);
    }

    public function next()
    {
        return next($this->folders);
    }

    public function key()
    {
        return key($this->folders);
    }

    public function valid()
    {
        return $this->current();
    }

    public function rewind()
    {
        reset($this->folders);
    }
}