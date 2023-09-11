<?php

namespace Michaelrk02\DbImporter;

use mysqli;

/**
 * MysqlDriver class
 *
 * @see MysqlDriver::import() for driver options
 */
class MysqlDriver implements DriverInterface
{
    /**
     * Import an SQL file
     *
     * @param string $filename SQL file path
     * @param array $options Driver-specific options:
     *
     * - `host`: database hostname
     * - `port`: database port
     * - `user`: database user
     * - `pass`: database password
     * - `name`: database name to use
     *
     * @return void
     */
    public function import($filename, $options)
    {
        $db = new mysqli($options['host'], $options['user'], $options['pass'], $options['name'], $options['port']);
        $db->multi_query(file_get_contents($filename));
        while ($db->next_result()) {
        }
    }
}
