<?php

namespace Michaelrk02\DbImporter;

use mysqli;

/**
 * MysqlDriver class
 */
class MysqlDriver implements DriverInterface
{
    /**
     * @var object $db
     */
    protected $db;

    /**
     * Construct a new MysqlDriver object
     *
     * @param array $options Connection options:
     *
     * - `host`: database hostname
     * - `port`: database port
     * - `user`: database user
     * - `pass`: database password
     * - `name`: database name to use
     */
    public function __construct($options)
    {
        $this->db = new mysqli($options['host'], $options['user'], $options['pass'], $options['name'], $options['port']);
    }

    /**
     * Import an SQL file
     *
     * @param string $filename SQL file path
     *
     * @return void
     */
    public function import($filename)
    {
        $this->db->multi_query(file_get_contents($filename));
    }
}
