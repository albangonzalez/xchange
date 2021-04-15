<?php

namespace App\DataFixtures;

use App\Entity\Exchange;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExchangeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EXCHANGE_REFERENCE_CIBANCOA01 = 'cibanco01';

    public function load(ObjectManager $manager)
    {
        $pts[0] = new Point(-87.0747472719578, 20.623315637298795);
        $exchanges[0] = new Exchange();
        $exchanges[0]
            ->setName('G Capital')
            ->setAddressLine1('Av 10 / C 8 Nte y 6 Nte Bis')
            ->setAddressLine2('Local #2, Col. Centro, Mun. Solidaridad')
            ->setZipCode(77710)
            ->setCity($this->getReference(PlaceFixtures::CITY_REFERENCE_PDC))
            ->setCountry($this->getReference(PlaceFixtures::COUNTRY_REFERENCE_MX))
            ->setPt($pts[0]);

        $pts[1] = new Point(-87.07187025206844, 20.629468541611267);
        $exchanges[1] = new Exchange();
        $exchanges[1]
            ->setName('CI Banco')
            ->setAddressLine1('Av 10 / C 14 Nte y 14 Nte Bis')
            ->setAddressLine2('Local #5, Col. Centro, Mun. Solidaridad')
            ->setZipCode(77710)
            ->setCity($this->getReference(PlaceFixtures::CITY_REFERENCE_PDC))
            ->setCountry($this->getReference(PlaceFixtures::COUNTRY_REFERENCE_MX))
            ->setPt($pts[1]);

        $pts[2] = new Point(-87.07169088103586, 20.629714762101308);
        $exchanges[2] = new Exchange();
        $exchanges[2]
            ->setName('Intercam Banco')
            ->setAddressLine1('Av 10 / C 14 Nte bis y 16 Nte')
            ->setAddressLine2('Col. Centro, Mun. Solidaridad')
            ->setZipCode(77710)
            ->setCity($this->getReference(PlaceFixtures::CITY_REFERENCE_PDC))
            ->setCountry($this->getReference(PlaceFixtures::COUNTRY_REFERENCE_MX))
            ->setPt($pts[2]);

        $pts[3] = new Point(-87.07852685754702, 20.634997173685868);
        $exchanges[3] = new Exchange();
        $exchanges[3]
            ->setName('San Jorge')
            ->setAddressLine1('Carr Federal Chetumal - Cancún / C 30 Nte y Av Constituyentes')
            ->setAddressLine2('Mun. Solidaridad')
            ->setZipCode(77712)
            ->setCity($this->getReference(PlaceFixtures::CITY_REFERENCE_PDC))
            ->setCountry($this->getReference(PlaceFixtures::COUNTRY_REFERENCE_MX))
            ->setPt($pts[3]);

        $pts[4] = new Point(-87.08407075643466, 20.62760592655482);
        $exchanges[4] = new Exchange();
        $exchanges[4]
            ->setName('G Capital')
            ->setAddressLine1('Carr Federal Chetumal - Cancún / Av Benito Juarez y C 1 Sur')
            ->setAddressLine2('Mun. Solidaridad')
            ->setZipCode(77712)
            ->setCity($this->getReference(PlaceFixtures::CITY_REFERENCE_PDC))
            ->setCountry($this->getReference(PlaceFixtures::COUNTRY_REFERENCE_MX))
            ->setPt($pts[4]);

        $this->addReference(self::EXCHANGE_REFERENCE_CIBANCOA01, $exchanges[1]);

        foreach ($exchanges as $exchange) {
            $manager->persist($exchange);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PlaceFixtures::class
        ];
    }
}
