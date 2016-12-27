<?php

namespace PhpSchool\LearnCouchDb\Exercise;

use Doctrine\CouchDB\CouchDBClient;
use Faker\Generator;
use PhpSchool\CouchDb\CouchDbExerciseCheck;
use PhpSchool\PhpWorkshop\Exercise\AbstractExercise;
use PhpSchool\PhpWorkshop\Exercise\CliExercise;
use PhpSchool\PhpWorkshop\Exercise\ExerciseInterface;
use PhpSchool\PhpWorkshop\Exercise\ExerciseType;
use PhpSchool\PhpWorkshop\ExerciseCheck\FunctionRequirementsExerciseCheck;
use PhpSchool\PhpWorkshop\ExerciseCheck\SelfCheck;
use PhpSchool\PhpWorkshop\Input\Input;
use PhpSchool\PhpWorkshop\Result\CgiOutRequestFailure;
use PhpSchool\PhpWorkshop\Result\CgiOutResult;
use PhpSchool\PhpWorkshop\Result\Failure;
use PhpSchool\PhpWorkshop\Result\ResultInterface;
use PhpSchool\PhpWorkshop\Result\Success;
use Zend\Diactoros\Request;

/**
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class CreateADatabase extends AbstractExercise implements
    ExerciseInterface,
    CliExercise,
    SelfCheck,
    FunctionRequirementsExerciseCheck
{

    /**
     * @var Generator
     */
    private $faker;

    /**
     * @var string|null
     */
    private $createdDatabase;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Get the name of the exercise, like `Hello World!`.
     *
     * @return string
     */
    public function getName()
    {
        return 'Create a database manually';
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
        return 'Create a database manually using CURL';
    }

    /**
     * This method should return an array of strings which will be passed to the student's solution
     * as command line arguments.
     *
     * @return string[][] An array of string arguments.
     */
    public function getArgs()
    {
        $this->createdDatabase = $this->faker->word;
        return [
            [$this->createdDatabase],
        ];
    }

    /**
     * The method is passed the absolute file path to the student's solution and should return a result
     * object which indicates the success or not of the check.
     *
     * @param Input $input The input arguments passed to the program.
     * @return ResultInterface The result of the check.
     */
    public function check(Input $input)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, sprintf('http://127.0.0.1:5984/%s', $this->createdDatabase));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($statusCode === 200) {
            $this->removeDb($this->createdDatabase);
            return new Success(sprintf('Database \'%s\' has been created', $this->createdDatabase));
        }

        return new Failure(sprintf('Database \'%s\' has not been created', $this->createdDatabase));
    }

    /**
     * Cleanup
     */
    private function removeDb()
    {
        $client = CouchDBClient::create(['dbname' => $this->createdDatabase]);
        $client->deleteDatabase($this->createdDatabase);
    }

    /**
     * Returns an array of function names that the student's solution should use. The solution
     * will be parsed and checked for usages of these functions.
     *
     * @return string[] An array of function names that *should* be used.
     */
    public function getRequiredFunctions()
    {
        return ['curl_init', 'curl_exec'];
    }

    /**
     * Returns an array of function names that the student's solution should not use. The solution
     * will be parsed and checked for usages of these functions.
     *
     * @return string[] An array of function names that *should not* be used.
     */
    public function getBannedFunctions()
    {
        return [];
    }
}
