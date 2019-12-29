<?php


namespace Nicolask\Numerator;


class NumberFactory
{
    private $pdo;

    /**
     * NumberFactory constructor.
     * @param $pathToDbFile
     */
    public function __construct($pathToDbFile)
    {
        $fi = new \SplFileInfo($pathToDbFile);
        if (!$fi->isFile()) {
            touch($pathToDbFile);
        }

        if ($fi->getSize() === 0) {
            $this->pdo = new \PDO('sqlite:'.$pathToDbFile);
            $this->pdo->exec('CREATE TABLE numerator (number INTEGER PRIMARY KEY, created TEXT NOT NULL)');
        } else {
            $this->pdo = new \PDO('sqlite:'.$pathToDbFile);
        }
    }


    public function getNextNumber(): string
    {
        $this->pdo->exec("INSERT INTO numerator (created) VALUES (datetime('now'))");
        $lastId = $this->pdo->lastInsertId();
        return $lastId;
    }
}