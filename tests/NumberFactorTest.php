<?php


namespace Nicolask\Numerator;


use PHPUnit\Framework\TestCase;

class NumberFactorTest extends TestCase
{
    private static $dbFile;

    protected function setUp()
    {
        parent::setUp();

        $folder = sys_get_temp_dir();
        //self::$dbFile = $folder. '/testfile.db';
        self::$dbFile = tempnam($folder, "nkr");
    }

    protected function tearDown()
    {
        parent::tearDown();
        //unlink(self::$dbFile);
    }

    public function testCreateNumeratorOnExistingEmptyFile()
    {
        $this->assertInstanceOf(NumberFactory::class, new NumberFactory(self::$dbFile));
    }

    public function testCreateNumeratorOnNonExistingFile()
    {
        $pathToDbFile = sys_get_temp_dir() . "/nonExisting.db";
        $subject = new NumberFactory($pathToDbFile);
        $subject->getNextNumber();
        $number = $subject->getNextNumber();
        self::assertEquals('2', $number);
        unlink($pathToDbFile);
    }

    public function testFirstNumber()
    {
        $subject = new NumberFactory(self::$dbFile);
        $this->assertEquals('1', $subject->getNextNumber());
    }

    public function testNextNumber()
    {
        $subject = new NumberFactory(self::$dbFile);
        $subject->getNextNumber();
        $nextNumber = $subject->getNextNumber();
        $this->assertEquals('2', $nextNumber);
    }
}