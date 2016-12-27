<?php

ini_set('display_errors', 1);
date_default_timezone_set('Europe/London');
switch (true) {
    case (file_exists(__DIR__ . '/../vendor/autoload.php')):
        // Installed standalone
        require __DIR__ . '/../vendor/autoload.php';
        break;
    case (file_exists(__DIR__ . '/../../../autoload.php')):
        // Installed as a Composer dependency
        require __DIR__ . '/../../../autoload.php';
        break;
    case (file_exists('vendor/autoload.php')):
        // As a Composer dependency, relative to CWD
        require 'vendor/autoload.php';
        break;
    default:
        throw new RuntimeException('Unable to locate Composer autoloader; please run "composer install".');
}

use PhpSchool\CouchDb\CouchDbCheck;
use PhpSchool\LearnCouchDb\Exercise\CreateADatabase;
use PhpSchool\LearnCouchDb\Exercise\CreateADocument;
use PhpSchool\LearnCouchDb\Exercise\DeleteADocument;
use PhpSchool\LearnCouchDb\Exercise\DependencyHeaven;
use PhpSchool\LearnCouchDb\Exercise\SelectingDocuments;
use PhpSchool\LearnCouchDb\Exercise\SetupCouchDb;
use PhpSchool\LearnCouchDb\Exercise\UpdateADocument;
use PhpSchool\LearnCouchDb\Exercise\UsingViews;
use PhpSchool\PhpWorkshop\Application;

$app = new Application('Couch DB', __DIR__ . '/config.php');
$app->addCheck(CouchDbCheck::class);

$app->addExercise(SetupCouchDb::class);
$app->addExercise(CreateADatabase::class);
$app->addExercise(SelectingDocuments::class);
$app->addExercise(CreateADocument::class);
$app->addExercise(UpdateADocument::class);
$app->addExercise(DeleteADocument::class);
$app->addExercise(UsingViews::class);

$art = <<<ART
        _ __ _
       / |..| \
       \/ || \/
        |_''_|

      PHP SCHOOL
LEARNING FOR ELEPHPANTS
ART;

$app->setLogo($art);
$app->setFgColour('green');
$app->setBgColour('black');

return $app;
