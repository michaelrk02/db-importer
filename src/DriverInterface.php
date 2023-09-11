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
     *
     * @return void
     */
    public function import($filename);
}
