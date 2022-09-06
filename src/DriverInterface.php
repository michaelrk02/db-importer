<?php

namespace Michaelrk02\DbImporter;

/**
 * Driver interface
 */
interface DriverInterface
{
    /**
     * Import a SQL file
     *
     * @param string $filename SQL file path
     * @param bool $skipErrors Whether to ignore SQL errors and continue execution
     * @param string $hostname Connection hostname
     * @param string $username Connection username
     * @param string $password Connection password
     * @param string $database Database to connect
     *
     * @return void
     */
    public function import($filename, $skipErrors, $hostname, $username, $password, $database);
}
