<?php

namespace App\Model;

/**
 * While a Repository represent and provide access to a collection of objects,
 * domain models (entities) represent individual domain objects (rows) in your application.
 *
 * Entities are just value objects which contains no methods to manipulate the database.
 */
interface ModelInterface
{
    /**
     * Return the ID.
     *
     * @return string|int The ID
     */
    public function getId();

    /**
     * Convert to array.
     *
     * @return array Data
     */
    public function toArray();

    /**
     * Convert to json.
     *
     * @param int $options Options
     * @return string A json string
     */
    public function toJson($options = 0);
}