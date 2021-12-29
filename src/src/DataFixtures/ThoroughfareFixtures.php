<?php

namespace App\DataFixtures;

use App\DataFixtures\Trait\ReferenceName;
use App\Entity\Thoroughfare;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThoroughfareFixtures extends Fixture
{
    use ReferenceName;

    public const REFERENCE_NAME = 'thoroughfare';

    public const THOROUGHFARE = [
        ['CL', 'Calle'],
        ['PL', 'Plaza'],
        ['AV', 'Avenida'],
        ['GP', 'Grupo'],
        ['RR', 'Ribera'],
        ['CM', 'Camino'],
        ['SB', 'Subida'],
        ['BA', 'Barriada'],
        ['PT', 'Puente'],
        ['TR', 'Travesia'],
        ['ES', 'Estrada'],
        ['RM', 'Ramal'],
        ['BO', 'Barrio'],
        ['CP', 'Campa'],
        ['CR', 'Carretera'],
        ['MT', 'Monte'],
        ['CJ', 'Callejon'],
        ['PS', 'Paseo'],
        ['FA', 'Falda'],
        ['SR', 'Sendero'],
        ['AT', 'Alto'],
        ['JS', 'Jardines'],
        ['QS', 'Calzadas'],
        ['PZ', 'Plazuela'],
        ['QA', 'Carrera'],
        ['EL', 'Escalinatas'],
        ['PQ', 'Parque'],
        ['ML', 'Muelle'],
        ['VC', 'Viaducto'],
        ['GV', 'Gran Via'],
        ['AL', 'Alameda'],
        ['RS', 'Rampas'],
        ['CT', 'Cuesta'],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::THOROUGHFARE as $thoroughfareData) {
            $thoroughfare = new Thoroughfare();

            $thoroughfare
                ->setCode($thoroughfareData[0])
                ->setName($thoroughfareData[1])
            ;

            $manager->persist($thoroughfare);

            $this->addReference(
                $this->getReferenceName(self::REFERENCE_NAME, $thoroughfareData[0]),
                $thoroughfare
            );
        }

        $manager->flush();
    }
}
