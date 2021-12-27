<?php

namespace App\DataFixtures;

use App\Entity\Province;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProvinceFixtures extends Fixture
{
    public const PROVINCES = [
        ['01', 'Álava'],
        ['02', 'Albacete'],
        ['03', 'Alicante'],
        ['04', 'Almería'],
        ['05', 'Ávila'],
        ['06', 'Badajoz'],
        ['07', 'Islas Baleares'],
        ['08', 'Barcelona'],
        ['09', 'Burgos'],
        ['20', 'Gipuzkoa'],
        ['26', 'La Rioja'],
        ['39', 'Cantabria'],
        ['48', 'Bizkaia'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROVINCES as $provinceData) {
            $province = new Province();

            $province
                ->setCode($provinceData[0])
                ->setName($provinceData[1])
            ;

            $manager->persist($province);
        }

        $manager->flush();
    }
}
