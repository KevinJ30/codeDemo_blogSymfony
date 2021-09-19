<?php

namespace App\DataFixtures;

use App\Entity\Newsletter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NewsletterFixtures extends Fixture
{
    /**
     * Enregistrement de 30 inscriptions a la newsletter
     *
     * @param ObjectManager $manager
     **/
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i <= 30; $i++) {
            $manager->persist($this->registerNewsletter());
        }

        $manager->flush();
    }

    public function registerNewsletter() : Newsletter {
        $faker = Factory::create('fr-FR');

        $newsletter = new Newsletter();
        $newsletter->setEmail($faker->email);
        $newsletter->setRegistration(new \DateTimeImmutable());

        return $newsletter;
    }
}
