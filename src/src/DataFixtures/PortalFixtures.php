<?php

namespace App\DataFixtures;

use App\DataFixtures\Trait\ReferenceName;
use App\Entity\Portal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PortalFixtures extends Fixture implements DependentFixtureInterface
{
    use ReferenceName;

    public const PORTALS = [
        ['CL', 'Iruña', 1, null],
        ['CL', 'Iruña', 1, 'Y'],
        ['CL', 'Iruña', 2, null],
        ['CL', 'Iruña', 2, 'A'],
        ['CL', 'Iruña', 3, null],
        ['CL', 'Iruña', 4, null],
        ['CL', 'Iruña', 5, null],
        ['CL', 'Iruña', 6, null],
        ['AV', 'Aguirre Lehendakari', 1, null],
        ['AV', 'Aguirre Lehendakari', 2, null],
        ['AV', 'Aguirre Lehendakari', 3, null],
        ['AV', 'Aguirre Lehendakari', 4, null],
        ['AV', 'Aguirre Lehendakari', 5, null],
        ['AV', 'Aguirre Lehendakari', 6, null],
        ['AV', 'Aguirre Lehendakari', 7, null],
        ['AV', 'Aguirre Lehendakari', 9, null],
        ['AV', 'Aguirre Lehendakari', 10, null],
        ['CL', 'Larrakotorre', 1, 'Y'],
        ['CL', 'Larrakotorre', 2, null],
        ['CL', 'Larrakotorre', 2, 'Y'],
        ['CM', 'Etxezuribidea', 1, null],
        ['CM', 'Etxezuribidea', 2, null],
        ['CM', 'Etxezuribidea', 3, null],
        ['PL', 'Ibarrekolanda', 1, null],
        ['CL', 'Ibarrekolanda', 19, 'A'],
        ['CL', 'Ibarrekolanda', 20, null],
        ['CL', 'Ibarrekolanda', 21, null],
        ['CL', 'Ibarrekolanda', 22, null],
        ['CL', 'Ibarrekolanda', 23, null],
        ['CL', 'Ibarrekolanda', 24, null],
        ['CL', 'Ibarrekolanda', 25, null],
        ['CL', 'Ibarrekolanda', 26, null],
        ['CL', 'Ibarrekolanda', 28, null],
        ['CL', 'Ibarrekolanda', 30, null],
        ['CL', 'Ibarrekolanda', 32, null],
        ['CL', 'Ibarrekolanda', 34, null],
        ['CL', 'Ibarrekolanda', 36, null],
        ['PL', 'Sarrikoalde', 1, null],
        ['PL', 'Sarrikoalde', 2, null],
        ['PL', 'Sarrikoalde', 3, null],
        ['PL', 'Sarrikoalde', 4, null],
        ['PL', 'Sarrikoalde', 5, null],
        ['PL', 'Sarrikoalde', 6, null],
        ['PL', 'Sarrikoalde', 7, null],
        ['PL', 'Sarrikoalde', 8, null],
        ['PL', 'Sarrikoalde', 9, null],
        ['PL', 'Sarrikoalde', 10, null],
        ['PL', 'Sarrikoalde', 11, null],
        ['AV', 'Zarandoa', 1, null],
        ['AV', 'Zarandoa', 2, null],
        ['AV', 'Zarandoa', 3, null],
        ['AV', 'Zarandoa', 5, null],
        ['AV', 'Zarandoa', 7, null],
        ['AV', 'Zarandoa', 9, 'A'],
        ['AV', 'Zarandoa', 9, 'B'],
        ['AV', 'Zarandoa', 11, 'A'],
        ['AV', 'Zarandoa', 11, 'B'],
        ['AV', 'Zarandoa', 13, null],
        ['CL', 'Eraso General', 1, null],
        ['CL', 'Eraso General', 2, null],
        ['CL', 'Eraso General', 4, null],
        ['CL', 'Eraso General', 6, null],
        ['CL', 'Eraso General', 8, null],
        ['CL', 'Eraso General', 10, null],
        ['CL', 'Eraso General', 10, 'Y'],
        ['CL', 'Ybarra Rafaela', 1, 'A'],
        ['CL', 'Ybarra Rafaela', 1, 'B'],
        ['CL', 'Ybarra Rafaela', 2, null],
        ['CL', 'Ybarra Rafaela', 2, 'Y'],
        ['CL', 'Ybarra Rafaela', 3, 'A'],
        ['CL', 'Ybarra Rafaela', 3, 'B'],
        ['CL', 'Ybarra Rafaela', 4, null],
        ['CL', 'Ybarra Rafaela', 4, 'A'],
        ['CL', 'Ybarra Rafaela', 4, 'B'],
        ['CL', 'Ybarra Rafaela', 5, null],
        ['CL', 'Ybarra Rafaela', 6, null],
        ['CL', 'Ybarra Rafaela', 7, null],
        ['CL', 'Ybarra Rafaela', 7, 'A'],
        ['CL', 'Ybarra Rafaela', 8, null],
        ['CL', 'Ybarra Rafaela', 9, null],
        ['CL', 'Ybarra Rafaela', 10, null],
        ['CL', 'Galicia', 1, null],
        ['CL', 'Galicia', 2, null],
        ['CL', 'Galicia', 3, null],
        ['CL', 'Galicia', 4, null],
        ['CL', 'Tudela', 1, null],
        ['CL', 'Tudela', 3, null],
        ['CL', 'Tudela', 5, null],
        ['CL', 'Tudela', 7, null],
        ['CL', 'Orixe', 1, null],
        ['CL', 'Orixe', 3, null],
        ['CL', 'Orixe', 5, null],
        ['CL', 'Orixe', 6, null],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PORTALS as $portalData) {
            $portal = new Portal();

            $street = $this->getReference(
                $this->getReferenceName(StreetFixtures::REFERENCE_NAME, $portalData[0] . '-' . $portalData[1])
            );

            $portal
                ->setStreet($street)
                ->setNumber($portalData[2])
                ->setBis($portalData[3])
            ;

            $manager->persist($portal);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StreetFixtures::class,
        ];
    }
}
