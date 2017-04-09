<?php

namespace Domain\Interfaces;


use Iterator;

interface OfferItemsRepositoryInterface extends Iterator
{
    public function add(OfferItemInterface $offerItem);

    public function merge(OfferItemsRepositoryInterface $offerItems);

    public static function findByOfferId(int $offerId);
}