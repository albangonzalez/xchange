<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends Fixture implements DependentFixtureInterface
{
    public const CURRENCY_REFERENCE_MXN = 'mxn';
    public const CURRENCY_REFERENCE_EUR = 'eur';
    public const CURRENCY_REFERENCE_USD = 'usd';

    public function load(ObjectManager $manager)
    {
        $currencies['MXN'] = new Currency();
        $currencies['MXN']
            ->setName('Mexican Pesos')
            ->setCode('MXN')
            ->setSign('$')
            ->setOrigin($this->getReference(PlaceFixtures::COUNTRY_REFERENCE_MX));

        $currencies['EUR'] = new Currency();
        $currencies['EUR']
            ->setName('Euro')
            ->setCode('EUR')
            ->setSign('€')
            ->setOrigin($this->getReference(PlaceFixtures::CONTINENT_REFERENCE_EU));
        $manager->flush();

        $currencies['USD'] = new Currency();
        $currencies['USD']
            ->setName('US Dollar')
            ->setCode('USD')
            ->setSign('$')
            ->setOrigin($this->getReference(PlaceFixtures::COUNTRY_REFERENCE_US));

        $this->setReference(self::CURRENCY_REFERENCE_MXN, $currencies['MXN']);
        $this->setReference(self::CURRENCY_REFERENCE_EUR, $currencies['EUR']);
        $this->setReference(self::CURRENCY_REFERENCE_USD, $currencies['USD']);

        foreach ($currencies as $currency) {
            $manager->persist($currency);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PlaceFixtures::class
        ];
    }
}
