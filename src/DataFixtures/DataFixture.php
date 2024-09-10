<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Generator;

abstract class DataFixture extends Fixture
{
    protected function persist(object $entity, ObjectManager $manager): void
    {
        /** @var ClassMetadata<object> $metadata */
        $metadata = $manager->getClassMetaData($entity::class);
        $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());
        $manager->persist($entity);
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->provideEntities() as $entity) {
            $this->persist($entity, $manager);
        }

        $manager->flush();
    }

    /**
     * @return Generator<object>
     */
    abstract protected function provideEntities(): Generator;
}
