<?php

class Database
{

    private $database = 'quiztime';
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    protected $dbc = null;

    public function __construct()
    {
        try {
            $this->dbc = new mysqli($this->host, $this->user, $this->password, $this->database);
            $this->dbc->set_charset('utf8');
        } catch (mysqli_sql_exception $exc) {
            echo "Kapcsolódási hiba:" . $exc->getMessage();
        }
    }

    public function RunSQL($sql, ...$args)
    {
        try {
            $utasitas = $this->dbc->prepare($sql);
            if (count($args) != 0)
                $utasitas->bind_param(str_repeat("s", count($args)), ...$args);
            $utasitas->execute();
            $result = $utasitas->get_result();
            return $result;
        } catch (mysqli_sql_exception $exc) {
            echo "Lekérdezési hiba: " . $exc->getMessage();
        }
    }

    public function get_last_insert()
    {
        return $this->dbc->insert_id;
    }
    public function FetchData($sql, $args = [])
    {
        $result = $this->RunSQL($sql, ...$args);
        if ($result->num_rows > 0) {
            $returnValue = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $returnValue = [];
        }
        return $returnValue;
    }
}