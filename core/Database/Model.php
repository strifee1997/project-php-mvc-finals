<?php

declare(strict_types=1);

namespace Core\Database;

abstract class Model implements Findable, Persistable
{
    protected string $table;

    public function __construct(public ?QueryBuilder $db = null) {}

    public function find(int $id): mixed
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $stmt->fetch();
    }

    public function all(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class); 
    }

    public function save(array $data = []): bool
    {
        return $this->db->insert($this->table, $data);
    }

    public function update(int $id, array $data = []): bool
    {
        return $this->db->updateById($this->table, $id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->db->deleteById($this->table, $id);
    }
    
    public function searchBy(string $column, string $keyword): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} LIKE :keyword");
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}
