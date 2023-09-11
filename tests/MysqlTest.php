<?php

use Michaelrk02\DbImporter\Importer;
use Michaelrk02\DbImporter\MysqlDriver;
use PHPUnit\Framework\TestCase;

class MysqlTest extends TestCase
{
    private $db;
    private $importer;

    private function tableCount()
    {
        $result = $this->db->query('SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = \''.TEST_MYSQL_DB_NAME.'\'');
        $result = $result->fetch_row()[0];

        return $result;
    }

    private function reset()
    {
        $this->db->query('DROP TABLE IF EXISTS employee');
        $this->db->query('DROP TABLE IF EXISTS company');
    }

    public function setUp(): void
    {
        $this->db = new mysqli(TEST_MYSQL_DB_HOST, TEST_MYSQL_DB_USER, TEST_MYSQL_DB_PASS, TEST_MYSQL_DB_NAME, TEST_MYSQL_DB_PORT);

        $options = [
            'host' => TEST_MYSQL_DB_HOST,
            'port' => TEST_MYSQL_DB_PORT,
            'user' => TEST_MYSQL_DB_USER,
            'pass' => TEST_MYSQL_DB_PASS,
            'name' => TEST_MYSQL_DB_NAME
        ];

        $this->importer = new Importer(new MysqlDriver(), $options);
    }

    public function testImport()
    {
        $this->reset();

        $this->assertEquals(0, $this->tableCount());
        $this->importer->import('tests/test.sql');
        $this->assertEquals(2, $this->tableCount());
    }
}
