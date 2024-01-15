<?php

namespace models;

use models\PizzeriaDB;
use PDO;

require_once 'PizzeriaDB.php';

class Offer
{
    private $id;
    private $title;
    private $image;
    private $description;

    public function __construct($id, $title, $image, $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public static function createConnection(): PDO
    {
        return PizzeriaDB::connectDB();
    }

    public function insert()
    {
        $conn = self::createConnection();
        $insert = "INSERT INTO offer (title, image, description) VALUES (\"" . $this->title . "\", \"" . $this->image . "\", \"" . $this->description . "\")";
        $conn->exec($insert);
    }

    public function delete()
    {
        $conn = self::createConnection();
        $delete = "DELETE FROM offer WHERE id=\"" . $this->id . "\"";
        $conn->exec($delete);
    }

    public static function findAll(): array
    {
        $conn = self::createConnection();
        $select = "SELECT id, title, image, description FROM offer";
        $result = $conn->query($select);

        $offers = [];
        while ($data = $result->fetchObject()) {
            $offers[] = new Offer($data->id, $data->title, $data->image, $data->description);
        }

        return $offers;
    }

    public static function findById($id): Offer
    {
        $conn = self::createConnection();
        $select = "SELECT id, title, image, description FROM offer WHERE id=\"" . $id . "\"";
        $result = $conn->query($select);
        $data = $result->fetchObject();
        return new Offer($data->id, $data->title, $data->image, $data->description);
    }
}
