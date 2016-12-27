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
class UpdateADocument extends AbstractExercise implements ExerciseInterface, CliExercise, CouchDbExerciseCheck
{
    /**
     * Get the name of the exercise, like `Hello World!`.
     *
     * @return string
     */
    public function getName()
    {
        return 'Update a document';
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
        return 'Update an existing document';
    }

    /**
     * @return string[][]
     */
    public function getArgs()
    {
        return [
            ['Pangolin']
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
        $couchDbClient->postDocument(['_id' => 'Pangolin', 'armour_level' => 8, 'cute_level' => 9]);
        $couchDbClient->postDocument(['_id' => 'Giant Tortoise', 'armour_level' => 9, 'cute_level' => 6]);
        $couchDbClient->postDocument(['_id' => 'Rhinoceros', 'armour_level' => 4, 'cute_level' => 5]);
    }

    /**
     * @param CouchDBClient $couchDbClient
     * @return bool
     */
    public function verify(CouchDBClient $couchDbClient)
    {
        $response = $couchDbClient->findDocument('Pangolin');

        return $response->status === 200
            && isset($response->body['cute_level'])
            && $response->body['cute_level'] === 10;

    }
}
