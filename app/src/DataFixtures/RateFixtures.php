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

        $rates[2] = new Rate();
        $rates[2]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_CIBANCOA01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_SELL))
            ->setValue(2115);

        $rates[3] = new Rate();
        $rates[3]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_CIBANCOA01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_BUY))
            ->setValue(1860);

        $rates[4] = new Rate();
        $rates[4]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_INTERCAM01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_EUR))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_SELL))
            ->setValue(2460);

        $rates[5] = new Rate();
        $rates[5]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_INTERCAM01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_EUR))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_BUY))
            ->setValue(2220);

        $rates[6] = new Rate();
        $rates[6]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_INTERCAM01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_SELL))
            ->setValue(2100);

        $rates[7] = new Rate();
        $rates[7]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_INTERCAM01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_BUY))
            ->setValue(1920);

        $rates[8] = new Rate();
        $rates[8]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_SANJORGE01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_EUR))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_SELL))
            ->setValue(2415);

        $rates[9] = new Rate();
        $rates[9]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_SANJORGE01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_EUR))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_BUY))
            ->setValue(2195);

        $rates[10] = new Rate();
        $rates[10]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_SANJORGE01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_SELL))
            ->setValue(2085);

        $rates[11] = new Rate();
        $rates[11]
            ->setExchange($this->getReference(ExchangeFixtures::EXCHANGE_REFERENCE_SANJORGE01))
            ->setCurrencySource($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_USD))
            ->setCurrencyTarget($this->getReference(CurrencyFixtures::CURRENCY_REFERENCE_MXN))
            ->setOrderType($this->getReference(OrderTypeFixtures::REFERENCE_ORDER_TYPE_BUY))
            ->setValue(1950);

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
