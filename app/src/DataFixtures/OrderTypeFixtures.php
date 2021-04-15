<?php

namespace App\DataFixtures;

use App\Entity\OrderType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderTypeFixtures extends Fixture
{
    public const REFERENCE_ORDER_TYPE_SELL = 'sell';
    public const REFERENCE_ORDER_TYPE_BUY = 'buy';

    public function load(ObjectManager $manager)
    {
        $orderTypes[0] = new OrderType();
        $orderTypes[0]->setCode('SELL');

        $orderTypes[1] = new OrderType();
        $orderTypes[1]->setCode('BUY');

        $this->setReference(self::REFERENCE_ORDER_TYPE_SELL, $orderTypes[0]);
        $this->setReference(self::REFERENCE_ORDER_TYPE_BUY, $orderTypes[1]);

        foreach ($orderTypes as $orderType) {
            $manager->persist($orderType);
        }

        $manager->flush();
    }
}
