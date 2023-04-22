<?php

require_once('config/database.php');

class Voto
{
    private $db;

    public function __construct() {
        $this->db = $GLOBALS['pdo'];
    }

    public function obtenerPorRut($rut)
    {
        $query = $this->db->prepare('SELECT * FROM votos WHERE rut = ?');
        $query->execute([$rut]);
        return $query->fetchAll();
    }
    
    public function store($voto)
    {
        $query = $this->db->prepare('INSERT INTO votos (nombre, alias, rut, email, comuna_id, candidato_id, como) VALUES (:nombre, :alias, :rut, :email, :comuna, :candidato, :como)');
        $query->bindParam(':nombre', $voto['nombre']);
        $query->bindParam(':alias', $voto['alias']);
        $query->bindParam(':rut', $voto['rut']);
        $query->bindParam(':email', $voto['email']);
        $query->bindParam(':comuna', $voto['comuna']);
        $query->bindParam(':candidato', $voto['candidato']);
        $query->bindParam(':como', $voto['como']);
        $query->execute();
        
        // verifica si inserción se ejecutó correctamente
        if ($query->rowCount() > 0) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
}