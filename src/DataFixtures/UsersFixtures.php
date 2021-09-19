<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Users\AdminUser;
use App\Entity\Users\MemberUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class UsersFixtures extends Fixture
{
    /**
     * Référence de l'utilisateur administrateur
     **/
    public const USER_REFERENCE_ADMIN = 'USER_REF_ADMIN';

    /**
     * Référence de l'utilisateur membre
     **/
    public const USER_REFERENCE_MEMBER = 'USER_REF_MEMBER';

    /**
     * @var UserPasswordHasherInterface $passwordHasher
     **/
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @var Generator $faker Faker
     **/
    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
        $this->faker = Factory::create();
    }

    /**
     * Initialise la fixture
     *
     * @param ObjectManager $manager
     **/
    public function load(ObjectManager $manager)
    {
        // Ajoute deux compte de référence
        $adminRefUser = $this->createAdminUser();
        $memberRefUser = $this->createMemberUser();

        $this->addReference(self::USER_REFERENCE_ADMIN, $adminRefUser);
        $this->addReference(self::USER_REFERENCE_MEMBER, $adminRefUser);

        $manager->persist($adminRefUser);
        $manager->persist($memberRefUser);

        // Ajoute 10 comptes aléatoire
        for($i = 0; $i <= 10; $i++) {
            $manager->persist($this->createRandomUser());
        }

        $manager->flush();
    }

    /**
     * Créer un utilisateur administrateur
     *
     * @return User
     **/
    private function createAdminUser() : User {
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $user->setRoles(['admin']);
        return $user;
    }

    /**
     * Créer un utilisateur membre
     *
     * @return User
     **/
    private function createMemberUser() : User {
        $user = new User();
        $user->setEmail('member@member.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'member'));
        return $user;
    }

    /**
     * Créer un utilisateur au hasard
     *
     * @return User
     **/
    private function createRandomUser() : User {
        $user = new User();

        if(rand(0, 1)) {
            $user->setRoles(['admin']);
        }

        $user->setEmail($this->faker->email);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'account'));
        return $user;
    }
}
