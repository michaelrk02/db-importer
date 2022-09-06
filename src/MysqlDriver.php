<?php

namespace Michaelrk02\DbImporter;

/**
 * MysqlDriver class
 */
class MysqlDriver implements DriverInterface
{
    /**
     * @var string $executable
     */
    protected $executable;

    /**
     * Construct a new MysqlDriver object
     *
     * @param string $executable Path to MySQL executable file
     */
    public function __construct($executable = '/usr/bin/mysql')
    {
        $this->executable = $executable;
    }

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
    public function import($filename, $skipErrors, $hostname, $username, $password, $database)
    {
        $filename = addslashes($filename);
        $hostname = addslashes($hostname);
        $username = addslashes($username);
        $password = addslashes($password);
        $database = addslashes($database);

        $options = '';
        if ($skipErrors) {
            $options .= ' --force';
        }

        $error = [];
        $exitCode = 0;
        exec($this->executable.' '.$options.' --host="'.$hostname.'" --user="'.$username.'" --password="'.$password.'" --database="'.$database.'" 0< "'.$filename.'"', $error, $exitCode);
        if ($exitCode != 0) {
            throw new \Exception(implode(PHP_EOL, $error));
        }
    }
}
