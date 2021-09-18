<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Ajoute les entrées dans la base de données
 *
 * Class PostFixtures
 * @package App\DataFixtures
 **/
class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i <= 10; $i++) {
            $manager->persist($this->createPost());
        }

        $manager->flush();
    }

    /**
     * Crée une entité générer avec Faker
     *
     * @return Post
     */
    private function createPost() : Post {
        $faker = Factory::create();

        $entity = new Post();
        $entity->setTitle($faker->title);
        $entity->setContent($faker->text(100));
        $entity->setPublish(new \DateTimeImmutable());
        $entity->setCategory($this->getReference(CategoryFixtures::REFERENCES));
        return $entity;
    }
}
