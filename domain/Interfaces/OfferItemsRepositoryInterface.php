<?php

namespace Domain\Interfaces;


interface OfferItemsRepositoryInterface extends RepositoryInterface
{
    public function add(OfferItemInterface $offerItem);

    public function merge(OfferItemsRepositoryInterface $offerItems);

    public static function findByOfferId(int $offerId);
}