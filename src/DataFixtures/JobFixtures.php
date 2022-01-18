<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    const JOB_TYPE = [
      'full-time',
      'part-time'
    ];
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=0; $i<10; $i++){
            $job = new Job();
            $job->setCategory($this->getReference($faker->randomElement([
                CategoryFixtures::CATEGORY_PROGRAMMING,
                CategoryFixtures::CATEGORY_DESIGN,
                CategoryFixtures::CATEGORY_MANAGER,
            ])));
            $job->setType($faker->randomElement(self::JOB_TYPE));
            $job->setCompany($faker->company);
            $job->setLogo($faker->imageUrl());
            $job->setUrl($faker->url);
            $job->setPosition($faker->jobTitle);
            $job->setLocation($faker->country);
            $job->setDescription($faker->text(1000));
            $job->setHowToApply($faker->paragraph);
            $job->setIsPublic($faker->boolean(50));
            $job->setIsActivated($faker->boolean(50));
            $job->setToken($faker->uuid);
            $job->setEmail($faker->email);
            $job->setExpiresAt($faker->dateTimeBetween('-1 year', '+1 year'));

            $manager->persist($job);
        }

        $manager->flush();
    }

        public function getDependencies()
        {
            return [
              CategoryFixtures::class
            ];
        }
}
