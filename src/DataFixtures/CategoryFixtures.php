<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class CategoryFixtures
 *
 * Enregistre les catégories
 *
 * @package App\DataFixtures
 **/
class CategoryFixtures extends Fixture
{
    public const REFERENCES = 'PHP';

    /**
     * Enregistre une catégorie de référence et ajoute 5 catégories supplémentaires
     *
     * @param ObjectManager $manager
     **/
    public function load(ObjectManager $manager)
    {
        $entity = new Category();
        $entity->setName('PHP');
        $entity->setDescription('Category PHP');

        $this->addReference(self::REFERENCES, $entity);

        $manager->persist($entity);
        $manager->flush();
    }

    /**
     * Crée une catégorie aléatoire
     *
     * @return Category
     **/
    public function createCategory() : Category {
        $faker = Factory::create('fr-FR');

        $category = new Category();
        $category->setName($faker->jobTitle);
        $category->setDescription($faker->text(100));
        return $category;
    }
}
