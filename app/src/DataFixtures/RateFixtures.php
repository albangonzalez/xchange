<?php

namespace App\DataFixtures;

use App\Entity\Rate;
use App\Repository\OrderTypeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RateFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $rates[0] = new Rate();
        $rates[0]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_CIBANCOA01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_EUR))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_SELL))
            ->setValue(2450);


        $rates[1] = new Rate();
        $rates[1]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_CIBANCOA01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_EUR))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_BUY))
            ->setValue(2276);

        $rates[3] = new Rate();
        $rates[3]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_CIBANCOA01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_SELL))
            ->setValue(2115);


        $rates[4] = new Rate();
        $rates[4]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_CIBANCOA01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_BUY))
            ->setValue(1860);

        foreach ($rates as $rate) {
             $manager->persist($rate);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ExchangeFixtures::class,
            CurrencyFixtures::class,
            OrderTypeFixtures::class
        ];
    }
}
