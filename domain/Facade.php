<?php

namespace Domain;


use Domain\Entities\OfferRepository;

class Facade
{
    public function findOffers($offset = 0, $limit = 100)
    {
        $offerRepository = new OfferRepository;

        $offerRepository->offset($offset);
        $offerRepository->limit($limit);
    }
}