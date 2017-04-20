<?php

namespace Domain\Entities;

use Domain\Interfaces\OfferItemInterface;
use Domain\Interfaces\OfferItemsRepositoryInterface;

class OfferItemsRepository extends BaseRepository implements OfferItemsRepositoryInterface
{
    public static function findByOfferId(int $offerId):self
    {
        return new self;
    }

    public function add(OfferItemInterface $offerItem):self
    {
        $this->items[] = $offerItem;
        return $this;
    }

    public function merge(OfferItemsRepositoryInterface $offerItems):self
    {
        $this->items = array_merge($this->items, $offerItems);
        return $this;
    }
}