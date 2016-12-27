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
class CreateADocument extends AbstractExercise implements ExerciseInterface, CliExercise, CouchDbExerciseCheck
{
    /**
     * Get the name of the exercise, like `Hello World!`.
     *
     * @return string
     */
    public function getName()
    {
        return 'Create a document';
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
        return 'Create a document manually using CURL';
    }

    /**
     * @return string[][]
     */
    public function getArgs()
    {
        return [];
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
    }

    /**
     * @param CouchDBClient $couchDbClient
     * @return bool
     */
    public function verify(CouchDBClient $couchDbClient)
    {
        $response = $couchDbClient->findDocument('phpschool');

        return $response->status === 200
            && isset($response->body['data'])
            && $response->body['data'] === 'ftw';

    }
}
