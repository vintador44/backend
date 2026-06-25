<?php

namespace App\Models;
use App\Config\Database;
use PDO;

Class Items
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getall(): array 
    {
    error_log('Connected to DB: ' . $this->db->query('SELECT current_database()')->fetchColumn());
    $sql = $this->db->query("SELECT * FROM item ORDER BY Id");
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;

    }

    public function get($id): ?array
    {
        $query = $this->db->prepare('SELECT * FROM item WHERE Id = :id');
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($id, $data) :?array
    {
         if (!$this->find($id)) return null;
        $query = $this->db->prepare('UPDATE item SET name = :name WHERE id = :id');
        $query->execute(['id' => $id, $data['name']]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;

        
    }
    public function delete(int$id): bool
    {
         if (!$this->find($id)) return null;
         $query = $this->db->prepare('DELETE FROM item WHERE id = :id');
         $query->execute(['id'=> $id]);
         $result = $query->fetch(PDO::FETCH_ASSOC);
         return $result;
    }

    public function create(int $id,$data): array
    {
         if (!$this->find($id)) return null;
         $query = $this->db->prepare('UPDATE item SET name = :name WHERE id = :id');
         $query->execute(['id' => $id, $data['name']]);
         $result = $query->fetch(PDO::FETCH_ASSOC);
         return $result;
    }
}
