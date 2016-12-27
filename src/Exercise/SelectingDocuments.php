<?php

namespace PhpSchool\LearnCouchDb\Exercise;

use Doctrine\CouchDB\CouchDBClient;
use PhpSchool\CouchDb\CouchDbCheck;
use PhpSchool\CouchDb\CouchDbExerciseCheck;
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
class SelectingDocuments extends AbstractExercise implements ExerciseInterface, CliExercise, CouchDbExerciseCheck
{
    /**
     * @var null|string
     */
    private $selectedAnimal;

    /**
     * @var array
     */
    private static $docs = [
        ['_id' => 'Pangolin', 'armour_level' => 8, 'cute_level' => 9],
        ['_id' => 'Giant Tortoise', 'armour_level' => 9, 'cute_level' => 6],
        ['_id' => 'Rhinoceros', 'armour_level' => 4, 'cute_level' => 5],
    ];


    /**
     * Get the name of the exercise, like `Hello World!`.
     *
     * @return string
     */
    public function getName()
    {
        return 'Selecting documents';
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
        return 'Selecting documents';
    }

    /**
     * @return string[][]
     */
    public function getArgs()
    {
        $this->selectedAnimal = self::$docs[array_rand(self::$docs)]['_id'];

        return [
            [$this->selectedAnimal]
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
    }

    /**
     * @param CouchDBClient $couchDbClient
     * @return bool
     */
    public function verify(CouchDBClient $couchDbClient)
    {
        return true;
    }
}
