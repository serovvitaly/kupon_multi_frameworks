<?php

namespace Domain\Entities;


use Domain\Interfaces\OfferRepositoryInterface;

class OfferRepository extends BaseRepository implements OfferRepositoryInterface
{

    public function offset(int $offset):self
    {
        return $this;
    }

    public function limit(int $limit):self
    {
        return $this;
    }
}