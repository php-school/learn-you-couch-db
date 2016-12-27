<?php

namespace PhpSchool\LearnCouchDb\Exercise;

use Doctrine\CouchDB\CouchDBClient;
use PhpSchool\CouchDb\CouchDbCheck;
use PhpSchool\CouchDb\CouchDbExerciseCheck;
use PhpSchool\LearnCouchDb\View\AnimalView;
use PhpSchool\PhpWorkshop\Exercise\AbstractExercise;
use PhpSchool\PhpWorkshop\Exercise\CliExercise;
use PhpSchool\PhpWorkshop\Exercise\ExerciseInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseType;
use PhpSchool\PhpWorkshop\ExerciseDispatcher;
use PhpSchool\PhpWorkshop\Result\CgiOutRequestFailure;
use PhpSchool\PhpWorkshop\Result\CgiOutResult;

/**
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class UsingViews extends AbstractExercise implements ExerciseInterface, CliExercise, CouchDbExerciseCheck
{
    /**
     * @var array
     */
    private static $docs = [
        ['name' => 'Pangolin', 'type' => 'armoured'],
        ['name' => 'Giant Tortoise', 'type' => 'armoured'],
        ['name' => 'Rhinoceros', 'type' => 'armoured'],
        ['name' => 'Raccoon', 'type' => 'furry'],
        ['name' => 'Polecat', 'type' => 'furry'],
        ['name' => 'Skunk', 'type' => 'furry'],
    ];

    /**
     * Get the name of the exercise, like `Hello World!`.
     *
     * @return string
     */
    public function getName()
    {
        return 'Using Views';
    }

    /**
     * Return the type of exercise. This is an ENUM. See `PhpSchool\PhpWorkshop\Exercise\ExerciseType`.
     *
     * @return ExerciseType
     */
    public function getType()
    {
        return ExerciseType::CLI();
    }

    /**
     * A short description of the exercise.
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Using Views';
    }

    /**
     * @return string[][]
     */
    public function getArgs()
    {
        return [
            []
        ];
    }

    public function configure(ExerciseDispatcher $dispatcher)
    {
        $dispatcher->requireCheck(CouchDbCheck::class);
    }

    /**
     * @param CouchDBClient $couchDbClient
     * @return void
     */
    public function seed(CouchDBClient $couchDbClient)
    {
        array_walk(self::$docs, function (array $doc) use ($couchDbClient) {
            $couchDbClient->postDocument($doc);
        });

        $couchDbClient->createDesignDocument('animals', new AnimalView);
    }

    /**
     * @param CouchDBClient $couchDbClient
     * @return bool
     */
    public function verify(CouchDBClient $couchDbClient)
    {
        return false;
    }
}
