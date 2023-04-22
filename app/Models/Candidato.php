<?php

require_once('config/database.php');

class Candidato
{
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['pdo'];
    }
    
    public function listar()
    {
        $query = $this->db->query('SELECT * FROM candidatos');
        return $query->fetchAll();
    }
}