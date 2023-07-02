<?php
namespace App\Infraestructure\Fixtures;

use App\Domain\Entities\Product;
use App\Domain\Entities\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private $encoderPassword;

    public function __construct(UserPasswordHasherInterface $encoderPassword)
    {
        $this->encoderPassword = $encoderPassword;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@admin.com');

        $hashedPassword = $this->encoderPassword->hashPassword(
            $user,
            'admin@admin.com'
        );

        $user->setPassword($hashedPassword);

        $manager->persist($user);

        $manager->flush();
    }

}
