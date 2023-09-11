<?php

use Michaelrk02\DbImporter\Importer;
use Michaelrk02\DbImporter\MysqlDriver;
use PHPUnit\Framework\TestCase;

class MysqlTest extends TestCase
{
    private $db;

    private function connect()
    {
        if ($this->db === null) {
            $this->db = new mysqli(TEST_MYSQL_DB_HOST, TEST_MYSQL_DB_USER, TEST_MYSQL_DB_PASS, TEST_MYSQL_DB_NAME, TEST_MYSQL_DB_PORT);
        }
        return $this->db;
    }

    private function reset()
    {
        $db = $this->connect();
        $db->query('DROP TABLE IF EXISTS employee');
        $db->query('DROP TABLE IF EXISTS company');
    }

    public function testImport()
    {
        $this->reset();

        $db = $this->connect();
        $result = $db->query('SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = \''.TEST_MYSQL_DB_NAME.'\'');
        $result = $result->fetch_row()[0];
        $this->assertEquals($result, 0);

        $options = [
            'host' => TEST_MYSQL_DB_HOST,
            'port' => TEST_MYSQL_DB_PORT,
            'user' => TEST_MYSQL_DB_USER,
            'pass' => TEST_MYSQL_DB_PASS,
            'name' => TEST_MYSQL_DB_NAME
        ];
        $importer = new Importer(new MysqlDriver(), $options);
        $importer->import('tests/test.sql');

        $result = $db->query('SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = \''.TEST_MYSQL_DB_NAME.'\'');
        $result = $result->fetch_row()[0];
        $this->assertEquals($result, 2);
    }
}
