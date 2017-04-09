<?php


use Domain\Interfaces\OfferInterface;

class OfferEntityTest extends TestCase
{
    protected function getOfferEntity()
    {
        $offer = Domain\Entities\Offer::factory(1);
        return $offer;
    }

    public function testAddItem()
    {
        $offer = $this->getOfferEntity();
    }

    public function testAddItems()
    {
        $offer = $this->getOfferEntity();
    }

    public function testGetItems()
    {
        $offer = $this->getOfferEntity();
        $offerItems = $offer->getItems();
        foreach ($offerItems as $offerItem) {
            var_dump($offerItem);
        }
        $this->assertTrue(true);
    }

    public function testFactory()
    {
        $offerId = 1;
        $offer = Domain\Entities\Offer::factory($offerId);
        $this->assertInstanceOf(OfferInterface::class, $offer);
        $this->assertEquals($offerId, $offer->getId());
    }
}