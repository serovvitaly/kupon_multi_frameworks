<?php

namespace Domain\Entities;

use Domain\Interfaces\OfferItemInterface;

class OfferItem extends IdentityEntity implements OfferItemInterface
{
    public static function factory(int $id):self
    {
        /** @var self $instance */
        $instance = parent::factory($id);

        return $instance;
    }
}