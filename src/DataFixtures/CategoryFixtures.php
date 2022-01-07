<?php

namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_DESIGN = 'design';
    public const CATEGORY_PROGRAMMING = 'programming';
    public const CATEGORY_MANAGER = 'manager';

    public function load(ObjectManager $manager): void
    {
        $designCategory = new Category();
        $designCategory->setName('Design');

        $programmingCategory = new Category();
        $programmingCategory->setName('Programming');

        $managerCategory = new Category();
        $managerCategory->setName('Manager');

        $manager->persist($designCategory);
        $manager->persist($programmingCategory);
        $manager->persist($managerCategory);
        $manager->flush();

        $this->addReference(self::CATEGORY_DESIGN,$designCategory);
        $this->addReference(self::CATEGORY_PROGRAMMING,$programmingCategory);
        $this->addReference(self::CATEGORY_MANAGER,$managerCategory);

    }
}
