<?php


namespace App\DataFixtures;


use App\Entity\Actor;
use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface

{
    const ACTORS = [
        'Paul Strentz',
        'Morgane Fath',
        'Yavuz Kutuk',
        'Gilles Samuel',
    ];



    public function load(ObjectManager $manager)
    {
        $i=0;
        $slugify = new Slugify();
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $slug = $slugify->generate($actor->getName());
            $actor->setSlug($slug);
            $manager->persist($actor);
            $actor->addProgram($this->getReference('program_' . rand(0,5)));
            $i++;
        }
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 50; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $slug = $slugify->generate($actor->getName());
            $actor->setSlug($slug);
            $actor->addProgram($this->getReference('program_' . rand(0,5)));
            $manager->persist($actor);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}