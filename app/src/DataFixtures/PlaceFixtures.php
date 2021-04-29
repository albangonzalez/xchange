<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlaceFixtures extends Fixture
{
    public const CITY_REFERENCE_PDC = 'pdc';
    public const COUNTRY_REFERENCE_MX  = 'mx';
    public const COUNTRY_REFERENCE_US  = 'us';
    public const CONTINENT_REFERENCE_EU  = 'eu';
    public function load(ObjectManager $manager)
    {
        $continentNames = [
            'AF' => 'Africa',
            'AS' => 'Asia',
            'EU' => 'Europe',
            'NA' => 'North America',
            'CA' => 'Central America',
            'SA' => 'South America',
            'OC' => 'Oceania',
        ];

        $countryNames = [
            'US' => 'United States of America',
            'FR' => 'France',
            'MX' => 'Mexico',
            'CO' => 'Colombia',
        ];

        $regionNames = [
            'IDFR' => 'Île-de-France',
            'QROO' => 'Quintana Roo',
            'VALL' => 'Valle del Cauca',
        ];

        $cityNames = [
            'PAR' => 'Paris',
            'PDC' => 'Playa del Carmen',
            'CUN' => 'Cancún',
            'CLO' => 'Cali',
        ];

        foreach ($continentNames as $code => $name) {
            $continent[$code] = new Place();
            $continent[$code]->setName($name);
            $continent[$code]->setCode($code);
        }

        foreach ($countryNames as $code => $name) {
            $country[$code] = new Place();
            $country[$code]->setName($name);
            $country[$code]->setCode($code);
        }

        foreach ($regionNames as $code => $name) {
            $region[$code] = new Place();
            $region[$code]->setName($name);
            $region[$code]->setCode($code);
        }

        foreach ($cityNames as $code => $name) {
            $city[$code] = new Place();
            $city[$code]->setName($name);
            $city[$code]->setCode($code);
        }

        $country['US']->setParent($continent['NA']);
        $country['FR']->setParent($continent['EU']);
        $country['MX']->setParent($continent['NA']);
        $country['CO']->setParent($continent['SA']);

        $region['IDFR']->setParent($country['FR']);
        $region['QROO']->setParent($country['MX']);
        $region['VALL']->setParent($country['CO']);

        $city['PAR']->setParent($region['IDFR']);
        $city['PDC']->setParent($region['QROO']);
        $city['CUN']->setParent($region['QROO']);
        $city['CLO']->setParent($region['VALL']);

        $this->addReference(self::CONTINENT_REFERENCE_EU, $continent['EU']);
        $this->addReference(self::COUNTRY_REFERENCE_US, $country['US']);
        $this->addReference(self::COUNTRY_REFERENCE_MX, $country['MX']);
        $this->addReference(self::CITY_REFERENCE_PDC, $city['PDC']);

        $places = $continent + $country + $region + $city;

        foreach ($places as $place) {
            $manager->persist($place);
        }

        $manager->flush();


    }
}
