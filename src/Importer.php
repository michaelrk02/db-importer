<?php

namespace Michaelrk02\DbImporter;

/**
 * Importer class
 */
class Importer
{
    /**
     * @var DriverInterface $driver
     */
    protected $driver;

    /**
     * @var string $hostname
     */
    protected $hostname;

    /**
     * @var string $username
     */
    protected $username;

    /**
     * @var string $password
     */
    protected $password;

    /**
     * @var string $database
     */
    protected $database;

    /**
     * Construct a new Importer object
     *
     * @param DriverInterface $driver Database driver
     * @param string $hostname Hostname to connect
     * @param string $username Username to connect
     * @param string $password Password to connect
     * @param string $database Database to connect
     */
    public function __construct($driver, $hostname, $username, $password, $database)
    {
        $this->driver = $driver;
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    /**
     * Import a SQL file
     *
     * @param string $filename SQL file path
     * @param bool $skipErrors Whether to ignore SQL errors and continue execution
     *
     * @return void
     */
    public function import($filename, $skipErrors = false)
    {
        $this->driver->import($filename, $skipErrors, $this->hostname, $this->username, $this->password, $this->database);
    }
}
