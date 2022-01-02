<?php

namespace App\DataFixtures;

use App\DataFixtures\Trait\ReferenceName;
use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture implements DependentFixtureInterface
{
    use ReferenceName;

    public const REFERENCE_NAME = 'city';

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
        ['20019', 'Beasain', 'gipuzkoa'],
        ['20040', 'Hernani', 'gipuzkoa'],
        ['20069', 'San Sebastián', 'gipuzkoa'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CITIES as $cityData) {
            $city = new City();

            $province = $this->getReference(
                $this->getReferenceName(ProvinceFixtures::REFERENCE_NAME, $cityData[2] ?? 'bizkaia')
            );

            $city
                ->setProvince($province)
                ->setCode($cityData[0])
                ->setName($cityData[1])
            ;

            $manager->persist($city);

            $this->addReference(
                $this->getReferenceName(self::REFERENCE_NAME, $cityData[1]),
                $city
            );
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
