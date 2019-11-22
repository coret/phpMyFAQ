<?php

namespace phpMyFAQ\Search;

/**
 * Factory class for phpMyFAQ search classes.
 *
 * This Source Code Form is subject to the terms of the Mozilla Public License,
 * v. 2.0. If a copy of the MPL was not distributed with this file, You can
 * obtain one at http://mozilla.org/MPL/2.0/.
 *
 * @package phpMyFAQ
 * @author Thorsten Rinne <thorsten@phpmyfaq.de>
 * @copyright 2010-2019 phpMyFAQ Team
 * @license http://www.mozilla.org/MPL/2.0/ Mozilla Public License Version 2.0
 * @link https://www.phpmyfaq.de
 * @since 2010-07-06
 */

use phpMyFAQ\Configuration;
use phpMyFAQ\Search\Database\Mysqli;
use phpMyFAQ\Search\Database\Pgsql;
use phpMyFAQ\Search\Database\Sqlite3;
use phpMyFAQ\Search\Database\Sqlsrv;

if (!defined('IS_VALID_PHPMYFAQ')) {
    exit();
}

/**
 * Class SearchFactory
 * @package phpMyFAQ\Search
 */
class SearchFactory
{
    /**
     * Factory for generating search instances.
     *
     * @param Configuration $config
     * @param array $searchHandler Array with information about search
     *                                     handlers, e.g. array('database' => 'mysqli')
     *
     * @return Mysqli|Pgsql|Sqlite3|Sqlsrv
     */
    public static function create(Configuration $config, Array $searchHandler)
    {
        $searchClass = sprintf('\phpMyFAQ\Search\%s\%s',
            ucfirst(key($searchHandler)),
            ucfirst(current($searchHandler)));

        return new $searchClass($config);
    }
}
