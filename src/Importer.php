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
     * @var array $options
     */
    protected $options;

    /**
     * Construct a new Importer object
     *
     * @param DriverInterface $driver Database driver
     * @param array $options Driver-specific options
     *
     * @see MysqlDriver
     */
    public function __construct($driver, $options)
    {
        $this->driver = $driver;
        $this->options = $options;
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
        $this->driver->import($filename, $this->options);
    }
}
