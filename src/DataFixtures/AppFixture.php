<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixture {

    protected Generator $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create('fr-FR');
        PostFixtures::loadFixtures($manager);
    }
}