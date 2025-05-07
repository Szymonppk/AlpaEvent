<?php

class Database
{
    private $host = 'db';
    private $port = '5432';
    private $dbname = 'AlpaDataBase';
    private $user = 'alpa_admin';
    private $password = 'AlpaEvent123!';
    private $connection;

    public function __construct()
    {
        try 
        {
            $this->connection = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname",
                $this->user,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage());
        }


    }
    
    public function getConnection(): PDO
    {
        return $this->connection;
    }


}