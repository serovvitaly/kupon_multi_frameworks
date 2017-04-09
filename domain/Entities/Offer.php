<?php

namespace Domain\Entities;

use Domain\Interfaces\OfferInterface;
use Domain\Interfaces\OfferItemInterface;
use Domain\Interfaces\OfferItemsRepositoryInterface;

class Offer extends IdentityEntity implements OfferInterface
{
    /** @var OfferItemsRepositoryInterface */
    protected $items;

    protected function init()
    {
        $this->items = OfferItemsRepository::findByOfferId($this->getId());
    }

    public function addItem(OfferItemInterface $offerItem):self
    {
        $this->items->add($offerItem);
        return $this;
    }

    public function addItems(OfferItemsRepositoryInterface $offerItems):self
    {
        $this->items->merge($offerItems);
        return $this;
    }

    public function getItems():OfferItemsRepositoryInterface
    {
        return $this->items;
    }
}