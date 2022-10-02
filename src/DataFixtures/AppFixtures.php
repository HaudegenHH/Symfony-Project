<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Conference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture {
    
    public function load(ObjectManager $manager): void {
        
        $faker = Factory::create();


        $cities = ['Hamburg', 'Berlin', 'München', 'Paris', 'London', 'Syndney', 'L.A.'];        

        for($i = 1; $i <= 3; $i++) {
            $conference = new Conference();
            $conference->setTitle($faker->sentence(3)); 
            $conference->setCity($cities[array_rand($cities)]);
            $conference->setYear(2022 - rand(1, 5));            
            $conference->setInternational((rand(0, 1000) / 1000) > 0.5 ? 1 : 0);

            $manager->persist($conference);

            for($j = 1; $j < 4; $j++) {
                $comment = new Comment();
                $comment->setAuthor($faker->name);
                $comment->setEmail($faker->email);
                $comment->setContent($faker->text(200));
                $comment->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 months')));
                $comment->setConference($conference);

                $manager->persist($comment);           
            }
        }

        $manager->flush();

    }
}
