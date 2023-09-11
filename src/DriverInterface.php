<?php

namespace Michaelrk02\DbImporter;

/**
 * Driver interface
 */
interface DriverInterface
{
    /**
     * Import an SQL file
     *
     * @param string $filename SQL file path
     * @param array $options Driver-specific options
     *
     * @return void
     */
    public function import($filename, $options);
}
