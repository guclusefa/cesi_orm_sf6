<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\Platform;
use App\Entity\Publisher;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        // 10 video games genres
        $genres = [
            'Action',
            'Adventure',
            'Fighting',
            'First-person shooter',
            'Flight simulator',
            'Hack and slash',
            'Massively multiplayer online role-playing game',
            'Platform',
            'Point-and-click',
            'Puzzle',
            'Real-time strategy',
            'Role-playing',
            'Simulation',
            'Sports',
            'Strategy',
            'Survival horror',
            'Tactical role-playing',
            'Third-person shooter',
            'Turn-based strategy',
            'Visual novel',
        ];
        // 10 video games types
        $types = [
            'Action-adventure',
            'Action role-playing',
            'Action strategy',
            'Adventure',
            'Beat \'em up',
            'Educational',
            'First-person shooter',
            'Flight simulator',
            'Hack and slash',
            'Massively multiplayer online role-playing game',
            'Music',
            'Platform',
            'Point-and-click',
            'Puzzle',
            'Real-time strategy',
            'Role-playing',
            'Simulation',
            'Sports',
            'Strategy',
            'Survival horror',
            'Tactical role-playing',
            'Third-person shooter',
            'Turn-based strategy',
            'Visual novel',
        ];
        // 10 video game platforms
        $platforms = [
            'PlayStation',
            'PlayStation 2',
            'PlayStation 3',
            'PlayStation 4',
            'Xbox',
            'Xbox 360',
            'Xbox One',
            'Nintendo Entertainment System',
            'Super Nintendo Entertainment System',
            'Nintendo 64',
            'GameCube',
            'Nintendo Switch',
        ];
        // 10 video game publishers
        $publishers = [
            'Activision',
            'Capcom',
            'Electronic Arts',
            'Konami',
            'Nintendo',
            'Sega',
            'Sony Computer Entertainment',
            'Square Enix',
            'Ubisoft',
            'Take-Two Interactive',
        ];
        // 10 video game developers
        $developers = [
            'Treyarch',
            'Naughty Dog',
            'Infinity Ward',
            'Rockstar North',
            'Rockstar Games',
            'Bungie',
            'BioWare',
            'Blizzard Entertainment',
            'Valve',
            'Bethesda Game Studios',
        ];
        // 10 video game titles
        $titles = [
            'Call of Duty: Black Ops Cold War',
            'Call of Duty: Modern Warfare',
            'Call of Duty: Warzone',
            'Call of Duty: Black Ops 4',
            'Call of Duty: Black Ops 3',
            'Call of Duty: Black Ops 2',
            'Call of Duty: Black Ops',
            'Call of Duty: Ghosts',
            'Call of Duty: Advanced Warfare',
            'Call of Duty: Infinite Warfare',
        ];

        // begin transaction
        $manager->getConnection()->beginTransaction();
        $manager->getConnection()->setAutoCommit(false);
        // create 10 genres
        for ($i = 0; $i < 10; $i++) {
            $genre = new Genre();
            $genre->setDesignation($genres[array_rand($genres)]);
            $manager->persist($genre);
        }
        // crate 10 types
        for ($i = 0; $i < 10; $i++) {
            $type = new Type();
            $type->setDesignation($types[array_rand($types)]);
            $manager->persist($type);
        }
        // create 10 platforms
        for ($i = 0; $i < 10; $i++) {
            $platform = new Platform();
            $platform->setDesignation($platforms[array_rand($platforms)]);
            $manager->persist($platform);
        }
        // create 10 publishers
        for ($i = 0; $i < 10; $i++) {
            $publisher = new Publisher();
            $publisher->setDesignation($publishers[array_rand($publishers)]);
            $publisher->setCreationDate($faker->dateTimeBetween('-40 years', 'now'));
            $manager->persist($publisher);
        }
        $manager->flush();
        // create 10 developers
        for ($i = 0; $i < 10; $i++) {
            $publishers = $manager->getRepository(Publisher::class)->findAll();
            $developer = new Developer();
            $developer->setDesignation($developers[array_rand($developers)]);
            $developer->setCreationDate($faker->dateTimeBetween('-40 years', 'now'));
            $developer->setParent($publishers[array_rand($publishers)]);
            $manager->persist($developer);
        }
        $manager->flush();
        // crate 10 games
        for ($i = 0; $i < 10; $i++) {
            $publishers = $manager->getRepository(Publisher::class)->findAll();
            $developers = $manager->getRepository(Developer::class)->findAll();
            $genres = $manager->getRepository(Genre::class)->findAll();
            $types = $manager->getRepository(Type::class)->findAll();
            $platforms = $manager->getRepository(Platform::class)->findAll();
            $game = new Game();
            $game->setTitle($titles[array_rand($titles)]);
            $game->setReleaseDate($faker->dateTimeBetween('-30 years', 'now'));
            // add 3 types
            for ($j = 0; $j < 3; $j++) {
                $game->addType($types[array_rand($types)]);
                $game->addGenre($genres[array_rand($genres)]);
                $game->addPlatform($platforms[array_rand($platforms)]);
                $game->addDeveloper($developers[array_rand($developers)]);
            }
            $game->setPublisher($publishers[array_rand($publishers)]);
            $manager->persist($game);
        }
        $manager->flush();
        // commit transaction
        $manager->getConnection()->commit();
    }
}
