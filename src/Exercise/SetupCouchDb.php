<?php

namespace PhpSchool\LearnCouchDb\Exercise;

use PhpSchool\PhpWorkshop\Exercise\AbstractExercise;
use PhpSchool\PhpWorkshop\Exercise\CustomExercise;
use PhpSchool\PhpWorkshop\Exercise\CustomVerifyingExercise;
use PhpSchool\PhpWorkshop\Exercise\ExerciseInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseType;
use PhpSchool\PhpWorkshop\Result\Failure;
use PhpSchool\PhpWorkshop\Result\ResultInterface;
use PhpSchool\PhpWorkshop\Result\Success;

/**
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class SetupCouchDb extends AbstractExercise implements ExerciseInterface, CustomVerifyingExercise
{

    /**
     * Get the name of the exercise, like `Hello World!`.
     *
     * @return string
     */
    public function getName()
    {
        return 'Setup Couch DB';
    }

    /**
     * Return the type of exercise. This is an ENUM. See `PhpSchool\PhpWorkshop\Exercise\ExerciseType`.
     *
     * @return ExerciseType
     */
    public function getType()
    {
        return ExerciseType::CUSTOM();
    }

    /**
     * A short description of the exercise.
     *
     * @return string
     */
    public function getDescription()
    {
        return 'Setup Couch DB so it is available to work with!';
    }


    /**
     * The method is passed the absolute file path to the student's solution and should return a result
     * object which indicates the success or not of the check.
     *
     * @return ResultInterface The result of the check.
     */
    public function verify()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_PORT, 5984);

        $output = json_decode(curl_exec($ch), true);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($statusCode === 200 && isset($output['couchdb'])) {
            return new Success('CouchDB is running on port 5984');
        }
        
        return new Failure('Couch DB', 'CouchDB is not running on port 5984');
    }

    /**
     * This method should return an array of strings which will be passed to the student's solution
     * as command line arguments.
     *
     * @return string[] An array of string arguments.
     */
    public function getArgs()
    {
        return [];
    }
}
