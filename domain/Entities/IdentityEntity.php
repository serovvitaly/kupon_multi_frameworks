<?php

namespace Domain\Entities;

use Domain\Interfaces\IdentityInterface;

/**
 * Базовый класс для всех идентифицируемых объектов
 * Class IdentityEntity
 * @package Domain\Entity
 */
abstract class IdentityEntity implements IdentityInterface
{
    private $id;

    private function __construct(int $id){
        $this->id = $id;
        $this->init();
    }

    protected function init(){}

    public function getId():int
    {
        return (int)$this->id;
    }

    public static function factory(int $id)
    {
        $className = get_called_class();
        return new $className($id);
    }
}