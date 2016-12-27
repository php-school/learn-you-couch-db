<?php

namespace PhpSchool\LearnCouchDb\View;

use Doctrine\CouchDB\View\DesignDocument;

/**
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class AnimalView implements DesignDocument
{

    /**
     * Get design doc code
     *
     * Return the view (or general design doc) code, which should be
     * committed to the database, which should be structured like:
     *
     * <code>
     *  array(
     *    "views" => array(
     *      "name" => array(
     *          "map"     => "code",
     *          ["reduce" => "code"],
     *      ),
     *      ...
     *    )
     *  )
     * </code>
     */
    public function getData()
    {
        return [
            'language' => 'javascript',
            'views' => [
                'armoured' => [
                    'map' => 'function(doc) {
                        if(doc.type && doc.type === "armoured" && doc.name) {
                            emit(doc._id, doc.name);
                        }
                    }',
                    'reduce' => '_count'
                ],
                'furries' => [
                    'map' => 'function(doc) {
                        if(doc.type && doc.type === "furry" && doc.name) {
                            emit(doc._id, doc.name);
                        }
                    }',
                    'reduce' => '_count'
                ]
            ]
        ];
    }
}
