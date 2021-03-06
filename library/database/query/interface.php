<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Database Query Interface
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Library\Database
 */
interface DatabaseQueryInterface
{
    /**
     * Bind values to a corresponding named placeholders in the query.
     *
     * @param  array $parameters Associative array of parameters.
     * @return DatabaseQueryInterface
     */
    public function bind(array $parameters);

    /**
     * Get the query parameters
     *
     * @return  DatabaseQueryParameters
     */
    public function getParameters();

    /**
     * Set the query parameters
     *
     * @param array $parameters  The query parameters
     * @return DatabaseQueryInterface
     */
    public function setParameters(array $parameters);

    /**
     * Gets the database adapter
     *
     * @return DatabaseAdapterInterface
     */
    public function getAdapter();
    
    /**
     * Set the database adapter
     *
     * @param  DatabaseAdapterInterface $adapter A DatabaseAdapterInterface object
     * @return DatabaseQueryInterface
     */
    public function setAdapter(DatabaseAdapterInterface $adapter);
}