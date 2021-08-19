<?php

namespace Service\ClickUp\Entity;

abstract class BaseEntity implements \JsonSerializable
{
    /*** Тег в phpDoc разрешающий конвертировать свойство в JSON */
    const OPEN_TO_SERIALIZE_DOC = '@openToSerialize';

    public function jsonSerialize()
    {
        $reflector = new \ReflectionClass(static::class);
        $properties = $reflector->getProperties();
        $arResult = [];

        foreach ($properties as $property) {
            if (strstr($property->getDocComment(), self::OPEN_TO_SERIALIZE_DOC) !== false) {
                $propName = $property->getName();
                $arResult[$propName] = $this->$propName;
            }
        }

        return $arResult;
    }
}