<?php

namespace App\Models;

use App\Core\Database;

abstract class Model {
    /** @var \PDO */
    protected $db;
    protected $table;
    protected $primaryKey = 'id';

    /**
     * @param ?\PDO $db Database connection (optional, will use default if not provided)
     */
    public function __construct(\PDO $db = null) {
        $this->db = $db ?: Database::getInstance()->getConnection();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(array $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute($data);
    }

    public function update($id, array $data) {
        $set = [];
        foreach (array_keys($data) as $key) {
            $set[] = "{$key} = :{$key}";
        }
        $set = implode(', ', $set);
        
        $sql = "UPDATE {$this->table} SET {$set} WHERE {$this->primaryKey} = :id";
        $data['id'] = $id;
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
