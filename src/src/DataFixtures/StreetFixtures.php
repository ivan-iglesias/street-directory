<?php

namespace App\DataFixtures;

use App\DataFixtures\Trait\ReferenceName;
use App\Entity\Street;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class StreetFixtures extends Fixture implements DependentFixtureInterface
{
    use ReferenceName;

    public const REFERENCE_NAME = 'street';

    public const STREETS = [
        ['CL', 'Iruña', '7fbe27e3-0b58-48dd-8ba3-8cd23df30105'],
        ['AV', 'Aguirre Lehendakari'],
        ['CL', 'Larrakotorre'],
        ['CM', 'Etxezuribidea'],
        ['PL', 'Ibarrekolanda'],
        ['CL', 'Ibarrekolanda'],
        ['PL', 'Sarrikoalde'],
        ['AV', 'Zarandoa'],
        ['CL', 'Eraso General'],
        ['CL', 'Ybarra Rafaela'],
        ['CL', 'Galicia'],
        ['CL', 'Tudela'],
        ['CL', 'Orixe'],
    ];

    public function load(ObjectManager $manager): void
    {
        $city = $this->getReference(
            $this->getReferenceName(CityFixtures::REFERENCE_NAME, 'bilbao')
        );

        foreach (self::STREETS as $streetData) {
            $street = new Street();

            $thoroughfare = $this->getReference(
                $this->getReferenceName(ThoroughfareFixtures::REFERENCE_NAME, $streetData[0])
            );

            $street
                ->setCity($city)
                ->setThoroughfare($thoroughfare)
                ->setName($streetData[1])
            ;

            if (count($streetData) === 3) {
                $street->setUuid(Uuid::fromString($streetData[2]));
            }

            $manager->persist($street);

            $this->addReference(
                $this->getReferenceName(self::REFERENCE_NAME, $streetData[0] . '-' . $streetData[1]),
                $street
            );
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ThoroughfareFixtures::class,
            CityFixtures::class,
        ];
    }
}
