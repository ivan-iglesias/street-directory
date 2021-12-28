<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROVINCE_REFERENCE_NAME = ProvinceFixtures::PROVINCE_REFERENCE . '-' . 'bizkaia';

    public const CITIES = [
        ['48001', 'Abadiño'],
        ['48012', 'Bakio'],
        ['48090', 'Balmaseda'],
        ['48013', 'Barakaldo'],
        ['48014', 'Barrikua'],
        ['48015', 'Basauri'],
        ['48017', 'Bermeo'],
        ['48019', 'Berriz'],
        ['48020', 'Bilbao'],
        ['48029', 'Etxebarri'],
        ['48030', 'Etxebarria'],
        ['48042', 'Gordexola'],
        ['48043', 'Gorliz'],
        ['48068', 'Mundaka'],
        ['48069', 'Mungia'],
        ['48077', 'Plentzia'],
        ['48078', 'Portugalete'],
        ['48082', 'Santurtzi'],
        ['48084', 'Sestao'],
        ['48904', 'Sondika'],
        ['48085', 'Sopelana'],
        ['48096', 'Zalla'],
        ['48905', 'Zamudio'],
        ['48097', 'Zaratamo'],
        ['48024', 'Zeanuri'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CITIES as $cityData) {
            $city = new City();

            $city
                ->setProvince(
                    $this->getReference(self::PROVINCE_REFERENCE_NAME)
                )
                ->setCode($cityData[0])
                ->setName($cityData[1])
            ;

            $manager->persist($city);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProvinceFixtures::class,
        ];
    }
}
