<?php

use function DI\factory;
use function DI\object;

use Faker\Generator;
use Interop\Container\ContainerInterface;
use PhpSchool\CouchDb\CouchDbCheck;
use PhpSchool\LearnCouchDb\Exercise\CreateADatabase;
use PhpSchool\LearnCouchDb\Exercise\CreateADocument;
use PhpSchool\LearnCouchDb\Exercise\DeleteADocument;
use PhpSchool\LearnCouchDb\Exercise\DependencyHeaven;
use PhpSchool\LearnCouchDb\Exercise\SelectingDocuments;
use PhpSchool\LearnCouchDb\Exercise\SetupCouchDb;
use PhpSchool\LearnCouchDb\Exercise\UpdateADocument;
use PhpSchool\LearnCouchDb\Exercise\UsingViews;

return [
    //Define your exercise factories here

    SetupCouchDb::class => object(),
    CreateADatabase::class => function (ContainerInterface $c) {
        return new CreateADatabase($c->get(Generator::class));
    },
    SelectingDocuments::class => object(),
    CreateADocument::class => object(),
    UpdateADocument::class => object(),
    DeleteADocument::class => object(),
    UsingViews::class => object(),

    CouchDbCheck::class => object()
];
