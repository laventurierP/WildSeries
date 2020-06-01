<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Service\Slugify;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $episode = new Episode();
            $episode->setSeason($this->getReference('season_' . random_int(0, 49)));
            $episode->setTitle($faker->title);
            $episode->setNumber($faker->randomNumber());
            $episode->setSynopsis($faker->title);
            $slug = $slugify->generate($episode->getTitle());
            $episode->setSlug($slug);
            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

}