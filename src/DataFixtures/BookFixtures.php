<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $hp_cpdf = new Book();
        $hp_cpdf->setTitle("Harry Potter et la coupe de feu");
        $hp_cpdf->setAuthor($this->getReference('author-rowling'));
        $hp_cpdf->addCategory($this->getReference('category-roman'));
        $hp_cpdf->addCategory($this->getReference('category-sf'));
        $hp_cpdf->setImage('hpelcdf.jpg');
        $hp_cpdf->setSlug('harry-potter-et-la-coupe-de-feu');
        $manager->persist($hp_cpdf);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class, AuthorFixtures::class];
    }
}
